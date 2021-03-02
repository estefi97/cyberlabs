<style>
    .a-header:hover {
        color: black !important;
    }
</style>
<a class="bold f-right-space f-left-space" style="color: black;" href="/webinars">{{ __("menuWebinars") }}</a>
<a class="bold f-right-space f-left-space" style="color: black;" href="/cursos">{{ __("HeaderCursos") }}</a>
<a class="bold f-right-space f-left-space" style="color: black;" href="/especialidades">{{ __("HeaderEspecialidades") }}</a>
<a class="f-main-btn premium-btn" data-turbolinks="false" href="/planes">{{ __("menuPlanes") }}</a>
<a class="bold f-right-space f-left-space" style="color: black;" href="/articulos">{{ __("menuArticulos") }}</a>
<div class="col-xs no-padding">
    <div class="box">
        <div class="row middle-xs">
            @include('partials.navigations.logged')
            <a href="{{ route('set_language', ['es']) }}"><img style="margin-left: 25px !important; margin-right: 5px !important;" src="{{ asset('images/es_flag.png') }}"></a>
            <a href="{{ route('set_language', ['en']) }}"><img style="margin-right: 5px !important;" src="{{ asset('images/en_flag.png') }}"></a>
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