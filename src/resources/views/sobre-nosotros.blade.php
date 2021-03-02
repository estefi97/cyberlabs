@extends('layouts.app')
<title>{{ __("TituloSobreNosotros") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
    <div class="article-container-width center-block paragraph">
        <h2 class="titulo-condiciones-de-uso">{{ __("SobreNosotros1") }}</h2>
        <p class="p-condiciones-de-uso">
            {{ __("SobreNosotros2") }}
        </p>
        <h2 class="titulo-condiciones-de-uso">{{ __("SobreNosotros3") }}</h2>
        <p class="p-condiciones-de-uso">
            {{ __("SobreNosotros4") }}
        </p>
        <h2 class="titulo-condiciones-de-uso">{{ __("SobreNosotros5") }}</h2>
        <ol class="ol-politicas-de-privacidad" style="list-style-type: unset !important; color: black !important;">
            <li>
                <p class="p-condiciones-de-uso">
                    {{ __("SobreNosotros7") }}
                </p>
            </li>
            <li>
                <p class="p-condiciones-de-uso">
                    {{ __("SobreNosotros8") }}
                </p>
            </li>
            <li>
                <p class="p-condiciones-de-uso">
                    {{ __("SobreNosotros9") }}
                </p>
            </li>
            <li>
                <p class="p-condiciones-de-uso">
                    {{ __("SobreNosotros10") }}
                </p>
            </li>
            <li>
                <p class="p-condiciones-de-uso">
                    {{ __("SobreNosotros11") }}
                </p>
            </li>
        </ol>
        <p align="center" style="margin-top: 5%">
            <iframe
                    width="560"
                    height="315"
                    src="https://www.youtube.com/embed/jsUblrOQs3o"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
            </iframe>
        </p>
    </div>
@endsection