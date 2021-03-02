@extends('layouts.app')
<title>{{ __("ArticulosPagina") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
    section {
        box-shadow: none !important;
    }
</style>
@section('content')
    <section class="Learning">
        <div class="Container">
            <h1 class="FeatureTitle FeatureTitle--Centered FeatureTitle--AlwaysVisible">
                <span style="color: black;">{{ __("ArticulosPagina1") }}</span> <span style="color: #0047FF;">{{ __("ArticulosPagina2") }}</span>
            </h1>
            @forelse($articles as $article)
                <div class="top-30" id="main-article-cover" style="padding-bottom:1px;margin-bottom:30px;">
                    <a href="/articulo/{{ $article->slug }}">
                        <article class="f-card f-padding-large f-shadow f-radius">
                            <div class="row">
                                <div class="background" style="width:418px;max-width:100%;background-image:url({{ $article->pathAttachment() }});min-height:120px;">
                                </div>
                                <div class="col-sm no-padding f-left-space no-margin-xs col-xs-12">
                                    <div class="box">
                                        <h3 class="no-margin normal-line-height h1" style="color: black; font-weight: 700 !important;">{{ $article->title }}</h3>
                                        @foreach ($article->users as $user)
                                            <aside class="row top-space middle-xs">
                                                <div class="right-space">
                                                    <div class="circle inline-block f-border f-premium-text middle-block" style="background-image:url({{ $user->pathAttachment() }});background-size:cover;background-position:center;width:30px;height:30px;margin:0 auto; margin-right: 10px;"></div>
                                                </div>
                                                <p class="no-margin" style="color: black; font-weight: 500">{{ $user->name.' '.$user->last_name }}</p>
                                            </aside>
                                        @endforeach
                                        <div class="f-top" style="color: black;">
                                            {{ strip_tags(\Illuminate\Support\Str::limit($article->content, 150, $end='...')) }}
                                        </div>
                                        <div class="f-top">
                                            <input type="submit" name="commit" value="{{ __("BotonArticulosContinuarLeyendo") }}" class="f-main-btn pull-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </a>
                </div>
            @empty
                <div class="alert alert-dark">
                    {{ __("ArticulosPagina3") }}
                </div>
            @endforelse

            <div class="row justify-content-center mt-5">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
@endsection