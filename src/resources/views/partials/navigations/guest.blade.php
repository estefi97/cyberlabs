<a class="bold f-right-space f-left-space" style="color: black;" href="/webinars">{{ __("menuWebinars") }}</a>
<a class="bold f-right-space f-left-space" style="color: black;" href="/cursos">{{ __("HeaderCursos") }}</a>
<a class="bold f-right-space f-left-space" style="color: black;" href="/especialidades">{{ __("HeaderEspecialidades") }}</a>
<a class="f-main-btn premium-btn" data-turbolinks="false" href="/planes">{{ __("menuPlanes") }}</a>
<a class="bold f-right-space f-left-space" style="color: black;" href="/articulos">{{ __("menuArticulos") }}</a>
<div class="col-xs no-padding">
    <div class="box">
        <div class="row middle-xs">
            <a class="f-grey-text f-right-space" style="color: black;" href="{{ route('register') }}">{{ __("HeaderRegistro") }}</a>
            <a class="f-grey-text f-right-space" style="color: black;" href="{{ route('login') }}">{{ __("HeaderIniciarSesion") }}</a>
            @if (app()->getLocale() === "es")
                <a
                        class="nav-link dropdown-toggle a-header"
                        href="#"
                        id="navbarDropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                >
                    <img src="{{ asset('images/es_flag.png') }}">
                </a>
            @endif
            @if (app()->getLocale() === "en")
                <a
                        class="nav-link dropdown-toggle a-header"
                        href="#"
                        id="navbarDropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                >
                    <img src="{{ asset('images/en_flag.png') }}">
                </a>
            @endif
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a
                        class="dropdown-item"
                        href="{{ route('set_language', ['es']) }}"
                >
                    {{ __("HeaderEspanolOpcion") }}
                </a>
                <a
                        class="dropdown-item"
                        href="{{ route('set_language', ['en']) }}"
                >
                    {{ __("HeaderInglesOpcion") }}
                </a>
            </div>
        </div>
    </div>
</div>