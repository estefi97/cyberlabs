<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\MessageToStudent;
use App\Role;
use App\Student;
use App\Teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
	public function courses () {
		$courses = Course::withCount(['students'])->with('category', 'reviews')
			->whereTeacherId(auth()->user()->teacher->id)->paginate(12);
		return view('teachers.courses', compact('courses'));
	}

    public function students () {
		$students = Student::with('user', 'courses.reviews')
			->whereHas('courses', function ($q) {
				$q->where('teacher_id', auth()->user()->teacher->id)->select('id', 'teacher_id', 'name')->withTrashed();
			})->get();

		$actions = 'students.datatables.actions';
		return \DataTables::of($students)->addColumn('actions', $actions)->rawColumns(['actions', 'courses_formatted'])->make(true);
    }

    public function sendMessageToStudent () {
    	$info = \request('info');
    	$data = [];
    	parse_str($info, $data);
    	$user = User::findOrFail($data['user_id']);
    	try {
    		\Mail::to($user)->send(new MessageToStudent( auth()->user()->name, $data['message']));
    		$success = true;
	    } catch (\Exception $exception) {
    		$success = false;
	    }
    	return response()->json(['res' => $success]);
    }

    public function agregarProfesor (Request $request) {
	    $teacher = new Teacher;
	    $teacher->user_id = $request->usuarioSeleccionado;
	    $teacher->title = $request->teacherTitle;
	    $teacher->biography = $request->teacherBiography;
	    $teacher->website_url = $request->teacherWebsite;
	    $teacher->save();
	    $user = User::find($request->usuarioSeleccionado);
	    $user->role_id = Role::TEACHER;
	    $user->save();
	    return redirect()->route('dashboard_profesores');
    }

    public function editarProfesor (Request $request) {
	    $teacher = Teacher::withTrashed()->find($request->idProfesor);
	    $teacher->title = $request->teacherTitle;
	    $teacher->biography = $request->teacherBiography;
	    $teacher->website_url = $request->teacherWebsite;
	    $teacher->save();
	    return redirect()->route('dashboard_profesores');
    }

    public function eliminarProfesor (Request $request) {
	    $currentDateTime = Carbon::now();
	    $teacher = Teacher::find($request->deleteId);
        $teacher->deleted_at = $currentDateTime->toDateTimeString();
        $teacher->save();
        $user = User::find($teacher->user_id);
        $user->role_id = Role::STUDENT;
        $user->save();
        return redirect()->route('dashboard_profesores');
    }

}
