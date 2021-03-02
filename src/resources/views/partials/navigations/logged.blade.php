<a id="navbarDropdownUser"
   class="nav-link dropdown-toggle a-header"
   href="#" role="button"
   data-toggle="dropdown"
   aria-haspopup="true"
   aria-expanded="false"
   style="color: black !important;"
>
    {{ auth()->user()->name }}{{ auth()->user()->last_name }} <span class="caret"></span>
</a>

<div class="dropdown-menu" aria-labelledby="navbarDropdownUser">

    <a class="dropdown-item" href="/perfil/{{ auth()->user()->id }}">{{ __("menuVerPerfil") }}</a>

    <a class="dropdown-item" href="{{ route('profile.editarPerfilUsuario') }}">{{ __("menuEditarPerfil") }}</a>

    @if (auth()->user()->role_id === \App\Role::STUDENT)
        <a class="dropdown-item" href="/subscriptions/admin">{{ __("TituloMisSuscripciones") }}</a>
    @endif

    @if (auth()->user()->role_id === \App\Role::ADMIN || auth()->user()->role_id === \App\Role::TEACHER)
        <a class="dropdown-item" href="/dashboard">Dashboard</a>
    @endif

    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"
    >
        {{ __("HeaderCerrarSesion") }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>