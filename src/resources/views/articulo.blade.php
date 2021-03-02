@extends('layouts.app')
<title>{{ $article->title }} | Hacktiva</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
    <div class="wrapper ">
        <div class="content">
            <div class="padding-top">
                <div class="container-fluid">
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                            <div class="img-wrap" style="border-radius: 50px !important; overflow: hidden !important;">
                                <img class="img-img lazy" src="{{ $article->pathAttachment() }}" alt="{{ $article->title }}" >
                                <div class="img-position img-description">
                                    <h1 class="h1-articulo"><b>{{ $article->title }}</b></h1>
                                </div>
                            </div>
                            <div class="well" style="background: transparent !important; border: none !important;">
                                <hr class="small">
                                @foreach ($article->users as $user)
                                <img class="avatar-60px pull-left" src="{{ $user->pathAttachment() }}" alt="{{ $user->name }}">
                                <h6 class="body-bta" style="color: black !important;">
                                    <a href="/perfil/{{ $user->id }}">{{ $user->name }}{{ $user->last_name }}</a>
                                </h6>
                                @endforeach
                                <a class="body-bta hidden-xs" style="color: black !important;" href="/articulo/{{ $article->slug }}">{{ __("Articulo1") }} {{ date('d/m/Y', strtotime($article->created_at)) }}</a>
                                <div class="post-body" style="color: black !important;">
                                    {!! $article->content !!}
                                </div>
                                <hr class="small">
                                <div class="row ">
                                    <div class="col-lg">
                                        <div class="col-lg-12 col-sm-6 col-xs-9 text-right">
                                            <br>
                                            <div class="social-share-button" data-title="Evitar SQL-Injection en Sistemas Cloud" data-img="" data-url="https://backtrackacademy.com/articulo/evitar-sql-injection-en-sistemas-cloud" data-desc="BacktrackAcademy: Evitar SQL-Injection en Sistemas Cloud" data-via="">
                                                <a rel="nofollow " data-site="linkedin" class="padding-icon a-curso-curso fa fa-linkedin" onclick="return SocialShareButton.share(this);" title="" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Compartir vía Linkedin"></a>
                                                <a rel="nofollow " data-site="twitter" class="padding-icon a-curso-curso fa fa-twitter" onclick="return SocialShareButton.share(this);" title="" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Compartir vía Twitter"></a>
                                                <a rel="nofollow " data-site="facebook" class="padding-icon a-curso-curso fa fa-facebook-f" onclick="return SocialShareButton.share(this);" title="" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Compartir vía Facebook"></a>
                                                <a rel="nofollow " data-site="google_plus" class="padding-icon a-curso-curso fa fa-google-plus" onclick="return SocialShareButton.share(this);" title="" href="#" data-toggle="tooltip" data-placement="top" data-original-title="Compartir vía Google+"></a>
                                                <a rel="nofollow " data-site="whatsapp_app" class="padding-icon a-curso-curso fa fa-whatsapp hidden-lg" onclick="return SocialShareButton.share(this);" title="Compartir vía Whatsapp app" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                            <h3 class="h3-articulo" style="color: black !important; font-weight: 700 !important">{{ __("Articulo2") }}</h3>
                            @forelse ($article->comments as $comment)
                            <div class="well" style="background-color: #051626 !important; border-radius: 30px !important;">
                                <div class="comment-8694 comment-item">
                                    @foreach($comment->users as $user)
                                        <div class="row justify-content-center">
                                            <div class="col-lg-1 col-xs-2">
                                                <img class="avatar pull-left" src="{{ $user->pathAttachment() }}" alt="{{ $user->name }}{{ $user->last_name }}"><br>
                                            </div>
                                            <div class="col-lg-10 col-xs-9">
                                                <a class="a-curso-curso" style="color: white !important" href="/perfil/{{ $user->id }}">{{ $user->name }}{{ $user->last_name }}</a>
                                                <br>
                                                <span class="body-bta custom-hover">{{ __("Articulo3") }} {{ $comment->created_at->diffForHumans(null, true) }}</span>
                                            </div>
                                            <div class="col-lg-1 col-xs-1">
                                            </div>
                                        </div>
                                    @endforeach
                                        <hr class="hr-articulo-comentario">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="body-bta">
                                                    <p class="p-articulo">{{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            @empty
                                <div class="alert alert-dark">
                                    {{ __("Articulo4") }}
                                </div>
                            @endforelse
                        </div>
                        @if (!Auth::guest())
                            <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                <h3 class="h3-articulo" style="color: black !important; font-weight: 700 !important;">{{ __("Articulo5") }}</h3>
                                <div class="">
                                    <form class="codemirror-comment" id="send_comment_post" action="{{ route('articulo.agregarComentario') }}" accept-charset="UTF-8" data-remote="true" method="POST">
                                        @csrf
                                        <input name="idArticulo" type="hidden" value="{{ $article->id }}">
                                        <div class="well" style="border-radius: 30px !important; overflow: hidden !important;">
                                            <textarea name="contenidoComentario" class="textarea-comentar" style="border-radius: 30px !important; overflow: hidden !important;"></textarea>
                                        </div>
                                        <input type="submit" name="commit" value="{{ __("Articulo6") }}" class="f-main-btn pull-right">
                                        <br><br>
                                    </form> </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //pElement
        let pElement = document.getElementsByTagName('p');
        for (let i = 0; i < pElement.length; i++) {
            pElement[i].classList.remove('p-articulo');
            pElement[i].className += 'p-articulo';
        }

        //h2Element
        let h2Element = document.getElementsByTagName('h2');
        for (let i = 0; i < h2Element.length; i++) {
            h2Element[i].classList.remove('h2-articulo');
            h2Element[i].className += 'h2-articulo';
        }

        //h3Element
        let h3Element = document.getElementsByTagName('h3');
        for (let i = 0; i < h3Element.length; i++) {
            h3Element[i].classList.remove('h3-articulo');
            h3Element[i].className += 'h3-articulo';
        }
    </script>
@endsection