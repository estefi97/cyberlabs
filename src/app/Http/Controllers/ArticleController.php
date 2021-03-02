<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function agregarArticulo (Request $request) {
        $article = new Article;
        $article->title = $request->titulo;
        $article->content = $request->contenido;
        $article->slug = str_slug($request->titulo, "-");

        if ($request->picture) {
            $imageName = $request->picture->getClientOriginalName();
            $request->picture->move(public_path('/images/articles'), $imageName);
            $article->picture = $imageName;
        }

        $article->save();
        $article->users()->attach($article->id, ['user_id' => auth()->user()->id]);
        return redirect()->route('dashboard_articulos');
    }

    public function editarArticulo (Request $request) {
        $currentDateTime = Carbon::now();
        $article = Article::withTrashed()->find($request->idArticulo);
        $article->title = $request->titulo;
        $article->status = $request->estado;
        $article->content = $request->contenido;
        $article->status = $request->estado;
        $article->slug = str_slug($request->titulo, "-");

        if ($request->picture) {
            $imageName = $request->picture->getClientOriginalName();
            $request->picture->move(public_path('/images/articles'), $imageName);
            $article->picture = $imageName;
        }

        if ($article->status === "1") {
            $article->deleted_at = null;
        }

        if ($article->status === "2") {
            $article->deleted_at = $currentDateTime->toDateTimeString();
        }

        $article->save();

        return redirect()->route('dashboard_articulos');
    }

    public function eliminarArticulo (Request $request) {
        $currentDateTime = Carbon::now();
        $article = Article::find($request->deleteId);
        $article->status = Article::DELETED;
        $article->deleted_at = $currentDateTime->toDateTimeString();
        $article->save();
        return redirect()->route('dashboard_articulos');
    }

    public function show (Article $article) {
        return view('articulo', compact('article'));
    }

    public function agregarComentario (Request $request) {
        $comment = new Comment;
        $comment->comment = $request->contenidoComentario;
        $comment->status = Comment::PUBLISHED;
        $comment->save();
        $comment->users()->attach($comment->id, ['user_id' => auth()->user()->id]);
        $comment->articles()->attach($request->idArticulo, ['comment_id' => $comment->id]);
        return back();
    }

    public function create () {
        $article = new Article;
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

    public function listArticles()
    {
        $articles = Article::select()
            ->where('status', Article::PUBLISHED)
            ->paginate(6);

        return view('articulos', compact('articles'));
    }
}
