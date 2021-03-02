<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Course;
use App\Mail\CourseApproved;
use App\Mail\CourseRejected;
use App\Module;
use App\Subscription;
use App\VueTables\EloquentVueTables;
use App\User;
use App\Article;
use App\Specialty;
use App\Teacher;
use App\Webinar;
use App\Plan;
use Illuminate\Http\Request;

class AdminController extends Controller
{

	public function courses () {
		return view('admin.courses');
	}

	public function inicio (User $user, Specialty $specialty, Course $course) {
	    return view('dashboard.inicio', compact('user','specialty','course'));
    }


    //  Articulos
    public function articulos (Article $article) {
	    return view('dashboard.articulos', compact('article'));
    }

    public function articulos_agregar () {
        return view('dashboard.articulos_acciones.agregararticulo');
    }

    public function articulos_editar (Request $request) {
        $article = Article::withTrashed()->find($request->id_articulo);
        return view('dashboard.articulos_acciones.editararticulo', compact('article'));
    }


    //  Comentarios
    public function comentarios (Comment $comment) {
	    return view('dashboard.comentarios', compact('comment'));
    }

    public function comentarios_editar (Request $request) {
	    $comment = Comment::withTrashed()->find($request->id_comentario);
	    return view('dashboard.comentarios_acciones.editarcomentario', compact('comment'));
    }


    //  Cursos
    public function cursos (Course $curso) {
	    return view('dashboard.cursos', compact('curso'));
    }

    public function cursos_agregar () {
        return view('dashboard.cursos_acciones.agregarcurso');
    }

    public function cursos_editar (Request $request) {
        $course = Course::withTrashed()->find($request->id_curso);
        return view('dashboard.cursos_acciones.editarcurso', compact('course'));
    }


    //  Especialidades
    public function especialidades (Specialty $specialty) {
	    return view('dashboard.especialidades', compact('specialty'));
    }

    public function especialidades_agregar (Specialty $specialty) {
        return view('dashboard.especialidades_acciones.agregarespecialidad', compact('specialty'));
    }

    public function especialidades_editar (Request $request) {
        $specialty = Specialty::withTrashed()->find($request->id_especialidad);
        return view('dashboard.especialidades_acciones.editarespecialidad', compact('specialty'));
    }


    //  Modulos Cursos
    public function moduloscursos (Module $module) {
	    return view('dashboard.moduloscursos', compact('module'));
    }

    public function moduloscursos_agregar (Module $module) {
        return view('dashboard.moduloscursos_acciones.agregarmodulo', compact('module'));
    }

    public function moduloscursos_editar (Request $request) {
        $module = Module::withTrashed()->find($request->id_modulo);
        return view('dashboard.moduloscursos_acciones.editarmodulo', compact('module'));
    }


    //  Planes
    public function planes (Plan $plan) {
	    return view('dashboard.planes', compact('plan'));
    }

    public function planes_agregar (Plan $plan) {
	    return view('dashboard.planes_acciones.agregarplan', compact('plan'));
    }

    public function planes_editar (Request $request) {
        $plan = Plan::withTrashed()->find($request->id_plan);
        return view('dashboard.planes_acciones.editarplan', compact('plan'));
    }


    //  Profesores
    public function profesores (Teacher $teacher) {
	    return view('dashboard.profesores', compact('teacher'));
    }

    public function profesores_agregar () {
	    return view('dashboard.profesores_acciones.agregarprofesor');
    }

    public function profesores_editar (Request $request) {
	    $teacher = Teacher::withTrashed()->find($request->id_profesor);
	    return view('dashboard.profesores_acciones.editarprofesor', compact('teacher'));
    }


    //  Suscripciones
    public function suscripciones (Subscription $subscription) {
	    return view('dashboard.suscripciones', compact('subscription'));
    }

    public function suscripciones_agregar () {
        return view('dashboard.suscripciones_acciones.agregarsuscripcion');
    }

    public function suscripciones_editar (Request $request) {
	    $subscription = Subscription::all()->where('id','=',$request->id_suscripcion)->toArray();
        return view('dashboard.suscripciones_acciones.editarsuscripcion', compact('subscription'));
    }


    //  Usuarios
    public function usuarios (User $user) {
	    return view('dashboard.usuarios', compact('user'));
    }

    public function usuarios_agregar () {
	    return view('dashboard.usuarios_acciones.agregarusuario');
    }

    public function usuarios_editar (Request $request) {
	    $user = User::withTrashed()->find($request->id_usuario);
	    return view('dashboard.usuarios_acciones.editarusuario', compact('user'));
    }


    //  Webinars
    public function webinars (Webinar $webinar) {
	    return view('dashboard.webinars', compact('webinar'));
    }

    public function webinars_agregar () {
	    return view('dashboard.webinars_acciones.agregarwebinar');
    }

    public function webinars_editar (Request $request) {
        $webinar = Webinar::withTrashed()->find($request->id_webinar);
        return view('dashboard.webinars_acciones.editarwebinar', compact('webinar'));
    }


	public function coursesJson () {
		if(request()->ajax()) {
			$vueTables = new EloquentVueTables;
			$data = $vueTables->get(new Course, ['id', 'name', 'status'], ['reviews']);
			return response()->json($data);
		}
		return abort(401);
	}

	public function updateCourseStatus () {
		if (\request()->ajax()) {
			$course = Course::find(\request('courseId'));

			if(
				(int) $course->status !== Course::PUBLISHED &&
				! $course->previous_approved &&
				\request('status') === Course::PUBLISHED
			) {
				$course->previous_approved = true;
				\Mail::to($course->teacher->user)->send(new CourseApproved($course));
			}

			if(
				(int) $course->status !== Course::REJECTED &&
				! $course->previous_rejected &&
				\request('status') === Course::REJECTED
			) {
				$course->previous_rejected = true;
				\Mail::to($course->teacher->user)->send(new CourseRejected($course));
			}

			$course->status = \request('status');
			$course->save();
			return response()->json(['msg' => 'ok']);
		}
		return abort(401);
	}

	public function students () {
		return view('admin.students');
	}

	public function teachers () {
		return view('admin.teachers');
	}
}
