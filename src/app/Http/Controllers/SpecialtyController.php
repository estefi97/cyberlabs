<?php


namespace App\Http\Controllers;

use App\Specialty;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function show (Specialty $specialty) {
        return view('especialidad', compact('specialty'));
    }

    public function create () {
        $specialty = new Specialty;
        $btnText = __("Enviar especialidad para revisión");
        return view('courses.form', compact('course', 'btnText'));
    }

    public function store (SpecialtyRequest $specialty_request) {
        $picture = Helper::uploadFile('picture', 'specialties');
        $specialty_request->merge(['picture' => $picture]);
        $specialty_request->merge(['teacher_id' => auth()->user()->teacher->id]);
        $specialty_request->merge(['status' => Specialty::PENDING]);
        Course::create($specialty_request->input());
        return back()->with('message', ['success', __('Curso enviado correctamente, recibirá un correo con cualquier información')]);
    }

    public function edit ($slug) {
        $specialty = Specialty::with(['requirements', 'goals'])->withCount(['requirements', 'goals'])
            ->whereSlug($slug)->first();
        $btnText = __("Actualizar especialidad");
        return view('courses.form', compact('course', 'btnText'));
    }

    public function update (SpecialtyRequest $specialty_request, Specialty $specialty) {
        if($specialty_request->hasFile('picture')) {
            \Storage::delete('specialties/' . $specialty->picture);
            $picture = Helper::uploadFile( "picture", 'specialties');
            $specialty_request->merge(['picture' => $picture]);
        }
        $specialty->fill($specialty_request->input())->save();
        return back()->with('message', ['success', __('Especialidad actualizada')]);
    }

    public function destroy (Specialty $specialty) {
        try {
            $specialty->delete();
            return back()->with('message', ['success', __("Especialidad eliminada correctamente")]);
        } catch (\Exception $exception) {
            return back()->with('message', ['danger', __("Error eliminando el curso")]);
        }
    }

    public function agregarEspecialidad (Request $request) {
        $specialty = new Specialty;
        $specialty->name = $request->nombreEspecialidad;
        $specialty->description = $request->descripcionEspecialidad;
        $specialty->slug = str_slug($request->nombreEspecialidad,'-');

        if ($request->imagenEspecialidad) {
            $imageName = $request->imagenEspecialidad->getClientOriginalName();
            $request->imagenEspecialidad->move(public_path('/images/specialties'), $imageName);
            $specialty->picture = $imageName;
        }

        $specialty->level_id = $request->nivelEspecialidad;
        $specialty->status = $request->estadoEspecialidad;
        $specialty->previous_approved = "0";
        $specialty->previous_rejected = "0";
        $specialty->save();

        $input = $request->all();
        if ($request->cursosAsociadosEspecialidad) {
            $hobby = $input['cursosAsociadosEspecialidad'];
            $input['cursosAsociadosEspecialidad'] = implode(',', $hobby);
            $cursosAsociados = array();
            $cursosAsociados = explode(',', $input['cursosAsociadosEspecialidad']);
            foreach ($cursosAsociados as $curso) {
                $specialty->courses()->attach($curso, ['specialty_id' => $specialty->id]);
            }
        }

        return redirect()->route('dashboard_especialidades');
    }

    public function editarEspecialidad (Request $request) {
        $currentDateTime = Carbon::now();
        $specialty = Specialty::withTrashed()->find($request->idEspecialidad);
        $specialty->courses()->detach();
        $specialty->name = $request->nombreEspecialidad;
        $specialty->description = $request->descripcionEspecialidad;
        $specialty->slug = str_slug($request->nombreEspecialidad,'-');

        if ($request->imagenEspecialidad) {
            $imageName = $request->imagenEspecialidad->getClientOriginalName();
            $request->imagenEspecialidad->move(public_path('/images/specialties'), $imageName);
            $specialty->picture = $imageName;
        }

        $specialty->level_id = $request->nivelEspecialidad;
        $specialty->status = $request->estadoEspecialidad;
        $specialty->previous_approved = "0";
        $specialty->previous_rejected = "0";

        if ($specialty->status === "1") {
            $specialty->deleted_at = null;
        }


        if ($request->estadoEspecialidad === "3") {
            $specialty->deleted_at = $currentDateTime->toDateTimeString();
        }

        $specialty->save();

        $input = $request->all();
        if ($request->cursosAsociadosEspecialidad) {
            $hobby = $input['cursosAsociadosEspecialidad'];
            $input['cursosAsociadosEspecialidad'] = implode(',', $hobby);
            $cursosAsociados = array();
            $cursosAsociados = explode(',', $input['cursosAsociadosEspecialidad']);
            foreach ($cursosAsociados as $curso) {
                $specialty->courses()->attach($curso, ['specialty_id' => $specialty->id]);
            }
        }

        return redirect()->route('dashboard_especialidades');
    }

    public function eliminarEspecialidad (Request $request) {
        $currentDateTime = Carbon::now();
        $specialty = Specialty::find($request->deleteId);
        $specialty->status = Specialty::REJECTED;
        $specialty->deleted_at = $currentDateTime->toDateTimeString();
        $specialty->save();
        return redirect()->route('dashboard_especialidades');
    }

    public function listSpecialties()
    {
        $specialties = Specialty::withCount(['courses'])
            ->where('status', Specialty::PUBLISHED)
            ->paginate(6);

        return view('especialidades', compact('specialties'));
    }
}