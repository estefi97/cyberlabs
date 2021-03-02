<?php


namespace App\Http\Controllers;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function editarComentario (Request $request) {
        $currentDateTime = Carbon::now();
        $comment = Comment::withTrashed()->find($request->idComentario);
        $comment->status = $request->estado;

        if ($comment->status === "1") {
            $comment->deleted_at = null;
        }

        if ($comment->status === "2") {
            $comment->deleted_at = $currentDateTime->toDateTimeString();
        }

        $comment->save();
        return redirect()->route('dashboard_comentarios');
    }

    public function eliminarComentario (Request $request) {
        $currentDateTime = Carbon::now();
        $comment = Comment::find($request->deleteId);
        $comment->status = Comment::DELETED;
        $comment->deleted_at = $currentDateTime->toDateTimeString();
        $comment->save();
        return redirect()->route('dashboard_comentarios');
    }
}