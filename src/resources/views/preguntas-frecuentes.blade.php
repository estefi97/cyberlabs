@extends('layouts.app')
<title>{{ __("TituloPreguntasFrecuentes") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
    .panel {
        background-color: transparent !important;
    }
    .panel-default {
        border: none !important;
    }
    .panel-default>.panel-heading {
        background-color: #0047ff !important;
        border-radius: 10px !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-offset-2 col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 mb-5">
                <div class="mt-5 mb-5">
                    <p class="titulo-condiciones-de-uso">
                        <span class="c6 h4 bold" style="font-size: 32px;">{{ __("PreguntasFrecuentesTitulo") }}</span>
                    </p>
                    <p class="p-condiciones-de-uso">{{ __("PreguntasFrecuentes1") }} <b>contacto@cyberlabs.com</b></p>
                    <hr class="small">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="a-preguntas-frecuentes" data-toggle="collapse" data-parent="#accordion" href="#collapse0">
                                    <h4 class="h4-preguntas-frecuentes bold">{{ __("PreguntasFrecuentes2") }}</h4>
                                </a>
                            </div>
                            <div id="collapse0" class="collapsible-header">
                                <div class="panel-body">
                                    {{ __("PreguntasFrecuentes3") }}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" style="margin-top: 20px;">
                            <div class="panel-heading">
                                <a class="a-preguntas-frecuentes" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                    <h4 class="h4-preguntas-frecuentes bold">{{ __("PreguntasFrecuentes6") }}</h4>
                                </a>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {{ __("PreguntasFrecuentes7") }}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="a-preguntas-frecuentes" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                    <h4 class="h4-preguntas-frecuentes bold">{{ __("PreguntasFrecuentes8") }}</h4>
                                </a>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {{ __("PreguntasFrecuentes9") }}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="a-preguntas-frecuentes" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                    <h4 class="h4-preguntas-frecuentes bold">{{ __("PreguntasFrecuentes10") }}</h4>
                                </a>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {{ __("PreguntasFrecuentes11") }}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="a-preguntas-frecuentes" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                    <h4 class="h4-preguntas-frecuentes bold">{{ __("PreguntasFrecuentes12") }}</h4>
                                </a>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {{ __("PreguntasFrecuentes13") }}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="a-preguntas-frecuentes" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                    <h4 class="h4-preguntas-frecuentes bold">{{ __("PreguntasFrecuentes14") }}</h4>
                                </a>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {{ __("PreguntasFrecuentes15") }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection