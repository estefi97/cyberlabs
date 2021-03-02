<?php


namespace App\Http\Controllers;

use App\Course;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InscriptionsController extends Controller
{

    public function verDashboardInscripciones() {
        return view('dashboard.inscripciones');
    }

    public function verDashboardAgregarInscripciones () {
        return view('dashboard.inscripciones_acciones.agregarinscripcion');
    }

    public function agregarInscripcion (Request $request) {

        $fechaAltaInscripcion = Carbon::now();

        if (DB::table('module_course')->where('course_id','=',$request->cursoSeleccionado)->count() > 0) {

            $idPrimerModuloDelCurso = DB::table('module_course')->where('course_id','=',$request->cursoSeleccionado)->join('modules','module_course.module_id','=','modules.id')->first()->id;

            if (DB::table('module_user')->where([['module_id','=',$idPrimerModuloDelCurso],['user_id','=',$request->usuarioSeleccionado]])->whereNull('deleted_at')->count() === 0) {

                $modules = DB::table('module_course')->where('course_id','=',$request->cursoSeleccionado)->select('module_id')->get()->toArray();
                foreach ($modules as $module) {
                    DB::insert('insert into module_user (module_id, user_id, status, created_at) values (?, ?, ?, ?)', [$module->module_id, $request->usuarioSeleccionado, '1', $fechaAltaInscripcion->toDateTimeString()]);
                }

                return redirect()->route('dashboard_inscripciones');

            } else {

                return redirect()->route('dashboard_inscripciones');

            }

        }

        return redirect()->route('dashboard_inscripciones');

    }

    public function eliminarInscripcion (Request $request) {
        $course = Course::find($request->deleteId);
        $user = User::find($request->deleteIdUsuario);
        $fechaEliminacionInscripcion = Carbon::now();
        $modules = DB::table('module_course')->where('course_id','=',$course->id)->select('module_id')->get()->toArray();
        foreach ($modules as $module) {
            DB::update('update module_user set deleted_at = ? where module_id = ? and user_id = ?', [$fechaEliminacionInscripcion->toDateTimeString(), $module->module_id, $user->id]);
        }
        return redirect()->route('dashboard_inscripciones');
    }

}