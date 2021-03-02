@extends('layouts.app')
<title>{{ __("TituloPestañaRecuperarContraseña") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
    main {
        min-height: 57vh !important;
    }
</style>
@section('content')
    <div class="small-container text-center f-top-medium" style="width:350px;max-width:95vw; margin-top: 100px !important;">
        <h1 class="h1 no-margin normal-line-height f-text-36" style="font-family: Lato, sans-serif; font-weight: 700; font-size: 27px !important;">{{ __("TituloRecuperarContraseña") }}</h1>
        <div class="f-top-intersection">
            <div class="f-top">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="devise-form form-login" id="user_log_in" action="{{ route('password.email') }}" accept-charset="UTF-8" method="post" novalidate>
                    @csrf
                    <div class="element text-left f-top-intersection">
                        <label class="f-label" for="user_password">{{ __("LoginInputEmail") }}</label>
                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} f-form-control light full-width f-top-small f-radius" required="required" id="email" minlength="8" type="text" name="email" autocomplete="off" placeholder="{{ __("LoginInputEmail") }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="f-top">
                        <button class="f-main-btn block full-width" type="submit">
                            {{ __("RecuperarContraseñaButton") }}
                        </button>
                    </div>
                </form></div>
        </div>
    </div>
@endsection
