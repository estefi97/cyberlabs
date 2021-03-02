<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Webinar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function agregarWebinar (Request $request) {
        $webinar = new Webinar;
        $webinar->title = $request->titulo;
        $webinar->link_video = $request->linkVideo;
        $webinar->status = $request->estado;
        $webinar->save();
        return redirect()->route('dashboard_webinars');
    }

    public function editarWebinar (Request $request) {
        $currentDateTime = Carbon::now();
        $webinar = Webinar::withTrashed()->find($request->idWebinar);
        $webinar->title = $request->titulo;
        $webinar->link_video = $request->linkVideo;
        $webinar->status = $request->estado;

        if ($webinar->status === "1") {
            $webinar->deleted_at = null;
        }

        if ($webinar->status === "2") {
            $webinar->deleted_at = $currentDateTime->toDateTimeString();
        }

        $webinar->save();
        return redirect()->route('dashboard_webinars');
    }

    public function eliminarWebinar (Request $request) {
        $currentDateTime = Carbon::now();
        $webinar = Webinar::find($request->deleteId);
        $webinar->status = Webinar::INACTIVE;
        $webinar->deleted_at = $currentDateTime->toDateTimeString();
        $webinar->save();
        return redirect()->route('dashboard_webinars');
    }

    public function show (Webinar $_webinar) {
        return view('webinar', compact('_webinar'));
    }

    public function agregarComentario (Request $request) {
        $comment = new Comment;
        $comment->comment = $request->contenidoComentario;
        $comment->status = Comment::PUBLISHED;
        $comment->save();
        $comment->users()->attach($comment->id, ['user_id' => auth()->user()->id]);
        $comment->webinars()->attach($request->idWebinar, ['comment_id' => $comment->id]);
        return back();
    }
}
