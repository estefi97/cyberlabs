<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                    <div class="brand-logo"></div>
                    <h2 style="color: #0047FF;" class="brand-text mb-0">Cyberlabs</h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header"><span>Menu</span></li>
            <li id="menuInicio" class="nav-item active">
                <a href="/dashboard">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Email">{{ __("DashboardInicio2") }}</span>
                </a>
            </li>

            @if (auth()->user()->role_id === \App\Role::ADMIN || auth()->user()->role_id === \App\Role::TEACHER)
                <li id="menuArticulos" class="nav-item">
                    <a href="/dashboard/articulos">
                        <i class="feather icon-file-text"></i>
                        <span class="menu-title" data-i18n="Email">{{ __("DashboardInicio3") }}</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role_id === \App\Role::ADMIN)
                <li id="menuAuditoria" class="nav-item has-sub">
                    <a href="#">
                        <i class="feather icon-eye"></i>
                        <span class="menu-title" data-i18n="Email">{{ __("menuDashboardAuditoria") }}</span>
                    </a>
                    <ul class="menu-content">
                        <li id="menuAuditoriaArticulos">
                            <a href="/dashboard/auditoria/articulos">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardArticulos") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaComentarios">
                            <a href="/dashboard/auditoria/comentarios">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardComentarios") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaCursos">
                            <a href="/dashboard/auditoria/cursos">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardCursos") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaEspecialidades">
                            <a href="/dashboard/auditoria/especialidades">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardEspecialidades") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaInscripciones">
                            <a href="/dashboard/auditoria/inscripciones">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardInscripciones") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaModulos">
                            <a href="/dashboard/auditoria/modulos">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardModulosCursos") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaPlanes">
                            <a href="/dashboard/auditoria/planes">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardPlanes") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaProfesores">
                            <a href="/dashboard/auditoria/profesores">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardProfesores") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaSuscripciones">
                            <a href="/dashboard/auditoria/suscripciones">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardSuscripciones") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaUsuarios">
                            <a href="/dashboard/auditoria/usuarios">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardUsuarios") }}</span>
                            </a>
                        </li>
                        <li id="menuAuditoriaWebinars">
                            <a href="/dashboard/auditoria/webinars">
                                <i class="feather icon-aperture"></i>
                                <span class="menu-item">{{ __("menuDashboardWebinars") }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->role_id === \App\Role::ADMIN || auth()->user()->role_id === \App\Role::TEACHER)
                <li id="menuComentarios" class="nav-item">
                    <a href="/dashboard/comentarios">
                        <i class="feather icon-message-square"></i>
                        <span class="menu-title" data-i18n="Calender">{{ __("DashboardInicio4") }}</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role_id === \App\Role::ADMIN)
                <li id="menuCursos" class="nav-item">
                    <a href="/dashboard/cursos">
                        <i class="feather icon-book"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("DashboardInicio5") }}</span>
                    </a>
                </li>
                <li id="menuEspecialidades" class="nav-item">
                    <a href="/dashboard/especialidades">
                        <i class="feather icon-award"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("DashboardInicio6") }}</span>
                    </a>
                </li>

                <li id="menuInscripciones" class="nav-item">
                    <a href="/dashboard/inscripciones">
                        <i class="feather icon-heart"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("menuDashboardInscripciones") }}</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role_id === \App\Role::ADMIN || auth()->user()->role_id === \App\Role::TEACHER)
                <li id="menuModulosCursos" class="nav-item">
                    <a href="/dashboard/modulos-cursos">
                        <i class="feather icon-database"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("DashboardInicio7") }}</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role_id === \App\Role::ADMIN)
                <li id="menuPlanes" class="nav-item">
                    <a href="/dashboard/planes">
                        <i class="feather icon-dollar-sign"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("DashboardInicio8") }}</span>
                    </a>
                </li>
                <li id="menuProfesores" class="nav-item">
                    <a href="/dashboard/profesores">
                        <i class="feather icon-mic"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("DashboardInicio9") }}</span>
                    </a>
                </li>
                <li id="menuSuscripciones" class="nav-item">
                    <a href="/dashboard/suscripciones">
                        <i class="feather icon-credit-card"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("DashboardInicio10") }}</span>
                    </a>
                </li>
                <li id="menuUsuarios" class="nav-item">
                    <a href="/dashboard/usuarios">
                        <i class="feather icon-user"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("DashboardInicio11") }}</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role_id === \App\Role::ADMIN || auth()->user()->role_id === \App\Role::TEACHER)
                <li id="menuWebinars" class="nav-item">
                    <a href="/dashboard/webinars">
                        <i class="feather icon-video"></i>
                        <span class="menu-title" data-i18n="Chat">{{ __("DashboardInicio12") }}</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>