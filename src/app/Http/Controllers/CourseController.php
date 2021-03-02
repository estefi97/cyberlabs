<?php

namespace App\Http\Controllers;

use App\Course;
use App\Goal;
use App\Helpers\Helper;
use App\Http\Requests\CourseRequest;
use App\Mail\NewStudentInCourse;
use App\Requirement;
use App\Review;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function show (Course $course) {
        if (!auth()->guest()) {
            switch (auth()->user()->role->name) {
                case "Admin":
                    list($vista,$course,$related) = $course->show($course, new \App\Strategy\AdminFormato);
                    return view($vista, compact('course', 'related'));
                case "Profesor":
                    list($vista,$course,$related) = $course->show($course, new \App\Strategy\ProfesorFormato);
                    return view($vista, compact('course','related'));
                case "Estudiante":
                    list($vista,$course,$related) = $course->show($course, new \App\Strategy\UsuarioFormato);
                    return view($vista, compact('course','related'));
                default:
                    return redirect('welcome');
            }
        } else {

            $course->load([
                'category' => function ($q) {
                    $q->select('id', 'name');
                },
                'goals' => function ($q) {
                    $q->select('id', 'course_id', 'goal');
                },
                'level' => function ($q) {
                    $q->select('id', 'name');
                },
                'requirements' => function ($q) {
                    $q->select('id', 'course_id', 'requirement');
                },
                'reviews.user',
                'teacher'
            ])->get();

            $related = $course->relatedCourses();

            return view('courses.detail', compact('course','related'));
        }
	}

	public function inscribe (Course $course) {
		$course->students()->attach(auth()->user()->student->id);

		\Mail::to($course->teacher->user)->send(new NewStudentInCourse($course, auth()->user()->name));

		return back()->with('message', ['success', __("Inscrito correctamente al curso")]);
	}

	public function subscribed () {
		$courses = Course::whereHas('students', function($query) {
			$query->where('user_id', auth()->id());
		})->get();
		return view('courses.subscribed', compact('courses'));
	}

	public function addReview () {
		Review::create([
			"user_id" => auth()->id(),
			"course_id" => request('course_id'),
			"rating" => (int) request('rating_input'),
			"comment" => request('message')
		]);
		return back()->with('message', ['success', __('Muchas gracias por valorar el curso')]);
	}

	public function create () {
		$course = new Course;
		$btnText = __("Enviar curso para revisión");
		return view('courses.form', compact('course', 'btnText'));
	}

	public function store (CourseRequest $course_request) {
		$picture = Helper::uploadFile('picture', 'courses');
		$course_request->merge(['picture' => $picture]);
		$course_request->merge(['teacher_id' => auth()->user()->teacher->id]);
		$course_request->merge(['status' => Course::PENDING]);
		Course::create($course_request->input());
		return back()->with('message', ['success', __('Curso enviado correctamente, recibirá un correo con cualquier información')]);
	}

	public function edit ($slug) {
		$course = Course::with(['requirements', 'goals'])->withCount(['requirements', 'goals'])
			->whereSlug($slug)->first();
		$btnText = __("Actualizar curso");
		return view('courses.form', compact('course', 'btnText'));
	}

	public function update (CourseRequest $course_request, Course $course) {
		if($course_request->hasFile('picture')) {
			\Storage::delete('courses/' . $course->picture);
			$picture = Helper::uploadFile( "picture", 'courses');
			$course_request->merge(['picture' => $picture]);
		}
		$course->fill($course_request->input())->save();
		return back()->with('message', ['success', __('Curso actualizado')]);
	}

	public function destroy (Course $course) {
		try {
			$course->delete();
			return back()->with('message', ['success', __("Curso eliminado correctamente")]);
		} catch (\Exception $exception) {
			return back()->with('message', ['danger', __("Error eliminando el curso")]);
		}
	}

	public function agregarCurso (Request $request) {
        $course = new Course;
        $course->category_id = "1";
        $course->level_id = $request->nivelSeleccionado;
        $course->name = $request->titulo;
        $course->description = $request->descripcion;
        $course->slug = str_slug($request->titulo, '-');

        if ($request->picture) {
            $imageName = $request->picture->getClientOriginalName();
            $request->picture->move(public_path('/images/courses'), $imageName);
            $course->picture = $imageName;
        }

        if ($request->profesorSeleccionado) {
            $course->teacher_id = DB::table('teachers')->where('user_id','=', $request->profesorSeleccionado)->select('id')->first()->id;
        }

        $course->status = Course::PUBLISHED;
        $course->previous_approved = 0;
        $course->previous_rejected = 0;

        $course->save();

        $input = $request->all();
        if ($request->metas) {
            $metasAsociadas = array();
            $metasAsociadas = explode('. ', $input['metas']);
            foreach ($metasAsociadas as $meta) {
                if ($meta != "") {
                    $Meta = new Goal;
                    $Meta->goal = ltrim($meta);
                    $Meta->save();
                    $course->goals()->attach($Meta, ['course_id' => $course->id]);
                }
            }
        }

        if ($request->requisitos) {
            $requisitosAsociados = array();
            $requisitosAsociados = explode(' || ', $input['requisitos']);
            foreach ($requisitosAsociados as $requisito) {
                if ($requisito != "") {
                    $Requisito = new Requirement;
                    $Requisito->requirement = ltrim($requisito);
                    $Requisito->save();
                    $course->requirements()->attach($Requisito, ['course_id' => $course->id]);
                }
            }
        }

        return redirect()->route('dashboard_cursos');
    }

    public function editarCurso (Request $request) {
        $currentDateTime = Carbon::now();
        $course = Course::withTrashed()->find($request->idCurso);
        $course->goals()->detach();
        $course->requirements()->detach();
        $course->category_id = "1";
        $course->level_id = $request->nivelSeleccionado;
        $course->name = $request->titulo;
        $course->description = $request->descripcion;
        $course->slug = str_slug($request->titulo, '-');

        if ($request->picture) {
            $imageName = $request->picture->getClientOriginalName();
            $request->picture->move(public_path('/images/courses'), $imageName);
            $course->picture = $imageName;
        }

        if ($request->profesorSeleccionado) {
            $course->teacher_id = DB::table('teachers')->where('user_id','=', $request->profesorSeleccionado)->select('id')->first()->id;
        }

        $course->previous_approved = 0;
        $course->previous_rejected = 0;
        $course->status = $request->estadoSeleccionado;

        if ($course->status === "1") {
            $course->deleted_at = null;
        }

        if ($course->status === "3") {
            $course->deleted_at = $currentDateTime->toDateTimeString();
        }

        $course->save();

        if ($request->estadoSeleccionado === Course::PUBLISHED) {

            $input = $request->all();
            if ($request->metas) {
                $metasAsociadas = array();
                $metasAsociadas = explode(' || ', $input['metas']);
                foreach ($metasAsociadas as $meta) {
                    if ($meta != "") {
                        $Meta = new Goal;
                        $Meta->goal = ltrim($meta);
                        $Meta->save();
                        $course->goals()->attach($Meta, ['course_id' => $course->id]);
                    }
                }
            }

            if ($request->requisitos) {
                $requisitosAsociados = array();
                $requisitosAsociados = explode(' || ', $input['requisitos']);
                foreach ($requisitosAsociados as $requisito) {
                    if ($requisito != "") {
                        $Requisito = new Requirement;
                        $Requisito->requirement = ltrim($requisito);
                        $Requisito->save();
                        $course->requirements()->attach($Requisito, ['course_id' => $course->id]);
                    }
                }
            }

        }

        return redirect()->route('dashboard_cursos');
    }

	public function eliminarCurso (Request $request) {
        $currentDateTime = Carbon::now();
        $course = Course::find($request->deleteId);
        $course->status = Course::REJECTED;
        $course->deleted_at = $currentDateTime->toDateTimeString();
        $course->save();
        return redirect()->route('dashboard_cursos');
    }

    public function listCourses()
    {
        $courses = Course::withCount(['students'])
            ->with('category', 'teacher', 'reviews')
            ->where('status', Course::PUBLISHED)
            ->latest()
            ->paginate(12);

        return view('cursos', compact('courses'));
    }

    public function inscripcionCurso(Request $request) {
        $cursoAInscribirse = Course::find($request->id_curso);
        if (DB::table('module_course')->where('course_id','=',$cursoAInscribirse->id)->count() > 0) {
            $linkPrimerModuloDelCurso = DB::table('module_course')->where('course_id','=',$cursoAInscribirse->id)->join('modules','module_course.module_id','=','modules.id')->first()->slug;
            $idPrimerModuloDelCurso = DB::table('module_course')->where('course_id','=',$cursoAInscribirse->id)->join('modules','module_course.module_id','=','modules.id')->first()->id;

            if (DB::table('module_user')->where([['module_id','=',$idPrimerModuloDelCurso],['user_id','=',$request->id_usuario]])->count() === 0) {

                $modules = DB::table('module_course')->where('course_id','=',$cursoAInscribirse->id)->select('module_id')->get()->toArray();
                foreach ($modules as $module) {
                    DB::insert('insert into module_user (module_id, user_id, status) values (?, ?, ?)', [$module->module_id, $request->id_usuario, '1']);
                }

                return redirect('/curso/'.$cursoAInscribirse->slug.'/'.$linkPrimerModuloDelCurso.'/');
                
            } else {

                return redirect('/curso/'.$cursoAInscribirse->slug.'/'.$linkPrimerModuloDelCurso.'/');

            }

        }
    }
}
