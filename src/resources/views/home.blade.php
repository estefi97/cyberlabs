@extends('layouts.app')
<title>{{ __("InicioPagina") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
    <div class="f-padding-x f-padding-100-y" style="max-width:100vw; padding-top: 50px !important; padding-bottom: 100px !important;">
        <div class="main-container">
            <div class="row middle-xs between-md center-xs">
                <div class="inline-block text-left text-center-sm first-md" style="width:550px;max-width:100%;">
                    <p class="h1 f-text-48 no-margin" style="font-weight: 700 !important; font-size: 32px !important;">
                        {{ __("Inicio1") }}
                        <br>
                        {{ __("Inicio2") }}
                        <br>
                        {{ __("Inicio3") }}
                    </p>
                    @if (Auth::guest())
                        <div class="f-top" style="margin-top: 30px !important;">
                            <a class="f-main-btn text-center h4 rb-normal inline-block" style="width:290px !important;max-width:100% !important; font-size: 18px !important;" href="{{ route('register') }}">{{ __("Inicio4") }}</a>
                        </div>
                    @endif
                </div>
                <div class="inline-block first-xs">
                    <img width="420" src="{{ asset('/images/imagen_inicio.png') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="f-padding-x f-padding-100-y" style="padding-top:0; padding-bottom: 50px !important;">
        <div class="main-container">
            <p class="h1 f-text-36 no-margin text-center" style="font-size: 36px !important; font-weight: 700 !important;">
                {{ __("Inicio5") }}</p>
            <div class="row text-center f-top">
                <div class="col-sm no-padding f-top-xs col-xs-12">
                    <div class="box">
                        <div class="top-space">
                            <img height="129" src="{{ asset('/images/imagen_inicio_1.svg') }}">
                            <p class="no-margin-top no-margin-bottom h4 rb-normal container-70" style="margin-top: 20px !important; font-size: 18px !important;">
                                {{ __("Inicio6") }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm no-padding no-margin-xs col-xs-12" style="margin-left:20px;margin-right:20px;">
                    <div class="box">
                        <div class="f-top-xs">
                            <div class="top-space">
                                <img height="129" src="{{ asset('/images/imagen_inicio_2.svg') }}">
                                <p class="no-margin-top no-margin-bottom h4 rb-normal container-70" style="margin-top: 20px !important; font-size: 18px !important;">
                                    {{ __("Inicio7") }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm no-padding f-top-xs col-xs-12">
                    <div class="box">
                        <div class="top-space">
                            <img height="129" src="{{ asset('/images/imagen_inicio_3.svg') }}">
                            <p class="no-margin-top no-margin-bottom h4 rb-normal container-70" style="margin-top: 20px !important; font-size: 18px !important;">
                                {{ __("Inicio8") }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
