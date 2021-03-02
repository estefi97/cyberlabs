<?php


namespace App\Http\Controllers;

use App\Module;
use App\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class ModuleController extends Controller
{

    public function show ($course, $module) {
        $courseId = DB::table('courses')->where('slug','=',$course)->first()->id;
        $moduleId = DB::table('modules')->where('slug','=',$module)->first()->id;
        $Module = Module::find($moduleId);
        $Course = Course::find($courseId);
        return view('modulo_curso', compact('Module','Course'));
    }

    public function agregarModulo (Request $request) {
        $modulo = new Module;
        $modulo->name = $request->nombreModuloCurso;
        $modulo->content = $request->contenidoModuloCurso;
        $modulo->description_challenge = $request->descripcionDesafioModuloCurso;
        $modulo->solution_challenge = $request->solucionDesafioModuloCurso;
        $modulo->status = $request->estadoModuloCurso;
        $modulo->slug = str_slug($request->nombreModuloCurso, '-');
        $modulo->save();

        $input = $request->all();

        if ($request->cursosAsociadosModuloCurso) {
            $hobby = $input['cursosAsociadosModuloCurso'];
            $input['cursosAsociadosModuloCurso'] = implode(',', $hobby);
            $cursosAsociados = array();
            $cursosAsociados = explode(',', $input['cursosAsociadosModuloCurso']);
            foreach ($cursosAsociados as $curso) {
                $values = array('course_id' => $curso, 'module_id' => $modulo->id, 'created_at' => $modulo->created_at, 'updated_at' => $modulo->updated_at);
                DB::table('module_course')->insert($values);
            }
        }

        return redirect()->route('dashboard_moduloscursos');
    }

    public function editarModulo (Request $request) {
        $currentDateTime = Carbon::now();
        $modulo = Module::withTrashed()->find($request->idModulo);
        $modulo->courses()->detach();
        $modulo->name = $request->nombreModuloCurso;
        $modulo->content = $request->contenidoModuloCurso;
        $modulo->description_challenge = $request->descripcionDesafioModuloCurso;
        $modulo->solution_challenge = $request->solucionDesafioModuloCurso;
        $modulo->status = $request->estadoModuloCurso;
        $modulo->slug = str_slug($request->nombreModuloCurso, '-');

        if ($modulo->status === "1") {
            $modulo->deleted_at = null;
        }

        if ($modulo->status === "2") {
            $modulo->deleted_at = $currentDateTime->toDateTimeString();
        }

        $modulo->save();

        if ($request->estadoModuloCurso === "1") {

            $input = $request->all();
            if ($request->cursosAsociadosModuloCurso) {
                $hobby = $input['cursosAsociadosModuloCurso'];
                $input['cursosAsociadosModuloCurso'] = implode(',', $hobby);
                $cursosAsociados = array();
                $cursosAsociados = explode(',', $input['cursosAsociadosModuloCurso']);
                foreach ($cursosAsociados as $curso) {
                    $values = array('course_id' => $curso, 'module_id' => $modulo->id, 'created_at' => $modulo->created_at, 'updated_at' => $modulo->updated_at);
                    DB::table('module_course')->insert($values);
                }
            }

        }

        return redirect()->route('dashboard_moduloscursos');
    }

    public function eliminarModulo (Request $request) {
        $currentDateTime = Carbon::now();
        $module = Module::find($request->deleteId);
        $module->status = Module::DELETED;
        $module->deleted_at = $currentDateTime->toDateTimeString();
        $module->save();
        return redirect()->route('dashboard_moduloscursos');
    }

    public function asignarModuloCompletadoAUsuario (Request $request) {
        $currentDateTime = Carbon::now();
        $idUsuario = $request->id_usuario;
        $idModuloCurso = $request->id_modulo_curso;
        DB::update('UPDATE module_user SET status = "2", created_at = ? where user_id = ? and module_id = ?',[$currentDateTime->toDateTimeString(), $idUsuario, $idModuloCurso]);
        return redirect()->route('dashboard_moduloscursos');
    }
}