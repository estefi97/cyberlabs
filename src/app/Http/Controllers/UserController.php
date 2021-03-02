<?php


namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function agregarUsuario (Request $request) {
        $user = new User;
        $user->role_id = $request->perfilUsuario;
        $user->name = $request->nombre;
        $user->last_name = $request->apellido;
        $user->slug = str_slug($user->name . " " . $user->last_name, "-");
        $user->email = $request->email;
        $user->password = \Hash::make($request->contrasena);

        if ($request->nuevaImagenUsuario) {
            $imageName = $request->nuevaImagenUsuario->getClientOriginalName();
            $request->nuevaImagenUsuario->move(public_path('/images/users'), $imageName);
            $user->picture = $imageName;
        }

        $user->save();

        if ($user->role_id === "1") {
            $student = new Student;
            $student->user_id = $user->id;
            $student->title = $request->studentTitle;
            $student->save();
            $teacher = new Teacher;
            $teacher->user_id = $user->id;
            $teacher->title = $request->teacherTitle;
            $teacher->biography = $request->teacherBiography;
            $teacher->website_url = $request->teacherWebsite;
            $teacher->save();
        }

        if ($user->role_id === "3") {
            $student = new Student;
            $student->user_id = $user->id;
            $student->title = $request->studentTitle;
            $student->save();
        }

        if ($user->role_id === "2") {
            $teacher = new Teacher;
            $teacher->user_id = $user->id;
            $teacher->title = $request->teacherTitle;
            $teacher->biography = $request->teacherBiography;
            $teacher->website_url = $request->teacherWebsite;
            $teacher->save();
        }

        return redirect()->route('dashboard_usuarios');
    }

    public function editarUsuario (Request $request) {
        $currentDate = Carbon::now();
        $user = User::withTrashed()->find($request->idUsuario);
        $user->name = $request->nombre;
        $user->last_name = $request->apellido;
        $user->slug = str_slug($user->name . " " . $user->last_name, "-");
        $user->email = $request->email;

        if ($request->contrasena) {
            $user->password = \Hash::make($request->contrasena);
        }

        if ($request->nuevaImagenUsuario) {
            $imageName = $request->nuevaImagenUsuario->getClientOriginalName();
            $request->nuevaImagenUsuario->move(public_path('/images/users'), $imageName);
            $user->picture = $imageName;
        }

        $user->role_id = $request->perfilUsuario;

        $user->save();

        $student = Student::all()->where('user_id', '=', $request->idUsuario);
        $teacher = Teacher::all()->where('user_id','=', $request->idUsuario);

        if ($student) {
            foreach ($student as $student) {
                $student->title = $request->studentTitle;
                $student->save();
            }
        } else if (!$student && $request->perfilUsuario === 3) {
            $student = new Student;
            $student->user_id = $request->idUsuario;
            $student->title = $request->studentTitle;
            $student->created_at = $currentDate->toDateTimeString();
            $student->save();
        }

        if ($teacher) {
            foreach ($teacher as $teacher) {
                $teacher->title = $request->teacherTitle;
                $teacher->website_url = $request->teacherWebsite;
                $teacher->biography = $request->teacherBiography;
                $teacher->save();
            }
        } else if (!$teacher && $request->perfilUsuario === 2) {
            $teacher = new Teacher;
            $teacher->user_id = $request->idUsuario;
            $teacher->title = $request->teacherTitle;
            $teacher->website_url = $request->teacherWebsite;
            $teacher->biography = $request->teacherBiography;
            $teacher->created_at = $currentDate->toDateTimeString();
            $teacher->save();
        }

        return redirect()->route('dashboard_usuarios');
    }

    public function eliminarUsuario (Request $request) {
        $currentDateTime = Carbon::now();
        $user = User::find($request->deleteId);
        $student = Student::all()->where('user_id', '=', $request->deleteId);
        $teacher = Teacher::all()->where('user_id','=', $request->deleteId);
        if ($teacher) {
            foreach ($teacher as $teacher) {
                Teacher::destroy($teacher->id);
            }
        }
        if ($student) {
            foreach ($student as $student) {
                Student::destroy($student->id);
            }
        }
        if ($user) {
            $user->deleted_at = $currentDateTime->toDateTimeString();
            $user->save();
        }
        return redirect()->route('dashboard_usuarios');
    }
}