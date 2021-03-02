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
    <h1 class="h1 no-margin normal-line-height f-text-36" style="font-family: Lato, sans-serif; font-weight: 700; font-size: 27px !important;">{{ __("TituloPestañaRecuperarContraseña") }}</h1>
    <div class="f-top-intersection">
        <div class="f-top">
            <form class="devise-form form-login" id="user_log_in" action="{{ route('password.request') }}" accept-charset="UTF-8" method="POST" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="element text-left f-top-intersection">
                    <label class="f-label" for="user_password">{{ __('LabelEmail') }}</label>
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} f-form-control light full-width f-top-small f-radius" required="required" id="email" minlength="8" type="text" name="email" autocomplete="off" placeholder="{{ __("LabelEmail") }}" value="{{ $email or old('email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="element text-left f-top-intersection">
                    <label class="f-label" for="user_password">{{ __('LabelContraseña') }}</label>
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} f-form-control light full-width f-top-small f-radius" required="required" id="password" minlength="8" type="password" name="password" autocomplete="off" placeholder="{{ __("LabelContraseña") }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="element text-left f-top-intersection">
                    <label class="f-label" for="user_password">{{ __('LabelConfirmarContraseña') }}</label>
                    <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} f-form-control light full-width f-top-small f-radius" required="required" id="password_confirmation" minlength="8" type="password" name="password_confirmation" autocomplete="off" placeholder="{{ __("LabelConfirmarContraseña") }}">
                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="f-top">
                    <button class="f-main-btn block full-width" type="submit">
                        {{ __("RecuperarContraseñaButton") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
