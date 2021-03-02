@component('mail::message')

# {{ __("Bienvenid@ a Cyberlabs!") }}

{{ __("Te damos la bienvenida a Cyberlabs!") }}

{{ __("Tus credenciales son:") }}

<strong>{{ __("Usuario: ") }}</strong> {{ $user['name'] }}<br>
<strong>{{ __("Contraseña: ") }}</strong> {{ $userPasswordNoHash }}

@component('mail::button', ['url' => url('/login')])
    {{ __("Ingresa a la Plataforma") }}
@endcomponent

{{ __("Gracias") }},<br>
{{ __("Cyberlabs") }}

@endcomponent