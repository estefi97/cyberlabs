@extends('layouts.app')
<title>{{ __("TituloLogin") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
    <div class="small-container text-center f-top-medium" style="width:350px;max-width:95vw; margin-top: 100px !important;">
        <h1 class="h1 no-margin normal-line-height f-text-36" style="font-family: Lato, sans-serif; font-weight: 700;">
            {{ __("EncabezadoLogin") }}</h1>
        <div class="f-top-intersection">
            <div class="f-top">
                <form class="devise-form form-login" id="user_log_in" action="{{ route('login') }}" accept-charset="UTF-8" method="post" novalidate>
                    @csrf
                    <div class="element text-left">
                        <label class="f-label" for="user_email">{{ __("LoginInputEmail") }}</label>
                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} f-form-control light full-width f-top-small f-radius" required="required" id="email" type="email" value="" name="email" autocomplete="off" placeholder="{{ __("LoginInputEmail") }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="element text-left f-top-intersection">
                        <label class="f-label" for="user_password">{{ __("LoginInputPassword") }}</label>
                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} f-form-control light full-width f-top-small f-radius" required="required" id="password" minlength="8" type="password" name="password" autocomplete="off" placeholder="{{ __("LoginInputPassword") }}">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="f-top">
                        <button class="f-main-btn block full-width" type="submit">
                            {{ __("LoginButton") }}
                        </button>
                    </div>
                </form></div>
        </div>
        <div class="f-top">
            <p class="f-label no-margin">
                {{ __("DescripcionLogin") }}
                <a class="bold underline" style="color: black;" target="_blank" href="/condiciones-de-uso">{{ __("DescripcionLogin1") }}</a>
                {{ __("DescripcionLogin2") }}
                <a class="bold underline" style="color: black;" target="_blank" href="/politicas-de-privacidad">{{ __("DescripcionLogin3") }}</a>
            </p>
        </div>
        <div class="f-top-medium">
            <a class="f-label" style="color: black;" href="{{ route('password.request') }}">{{ __("LoginOlvideMiContrasena") }}</a>
            <p class="f-label">
                {{ __("LoginNoTienesCuenta") }}
                <a class="bold" style="color: black;" href="{{ route('register') }}">{{ __("LoginCreaUnaCuentaAqui") }}</a>
            </p>
        </div>
    </div>
@endsection
