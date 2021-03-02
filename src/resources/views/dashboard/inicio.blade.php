@extends('dashboard.app')
<title>Dashboard | Hacktiva</title>
<style>
    @media only screen and (max-width: 1366px) and (min-width: 1366px) {
        i.feather.px-1 {
            width: 120px !important;
            height: 120px !important;
            float: none !important;
        }

        .card .card-title {
            display: inline-block;
            margin-top: 0.5rem !important;
        }
    }
</style>

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row">
                    <div class="container-fluid">
                        <div class="card bg-analytics text-white">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <img src="{{ asset('/images/decore-left.png') }}" class="img-left" alt="card-img-left"/>
                                    <img src="{{ asset('/images/decore-right.png') }}" class="img-right" alt="card-img-right"/>
                                    <div class="avatar avatar-xl bg-primary shadow mt-0">
                                        <div class="avatar-content">
                                            <i class="white font-large-1" data-feather="star"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="mb-2 text-white">¡{{ __("DashboardInicio14") }} {{ auth()->user()->name }}!</h1>
                                        <p class="m-auto w-75">
                                            {{ __("DashboardInicio15") }} <strong>{{ $user->count() }} {{ __("DashboardInicio11") }}</strong>, <strong>{{ $course->count() }}
                                            {{ __("DashboardInicio5") }}</strong> {{ __("DashboardInicio16") }} <strong>{{ $specialty->count() }}
                                            {{ __("DashboardInicio6") }}.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @if (auth()->user()->role_id === \App\Role::ADMIN)
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card text-white bg-gradient-primary text-center">
                                <div class="card-content d-flex">
                                    <div class="card-body">
                                        <i data-feather="user" class="feather px-1" style="width: 150px; height: 150px"></i>
                                        <h4 class="card-title text-white mt-3">{{ __("DashboardInicio11") }}</h4>
                                        <p class="card-text"></p>
                                        <a href="/dashboard/usuarios"><button class="btn btn-primary">{{ __("DashboardInicio13") }}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (auth()->user()->role_id === \App\Role::ADMIN || auth()->user()->role_id === \App\Role::TEACHER)
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card text-white bg-gradient-primary text-center">
                                <div class="card-content d-flex">
                                    <div class="card-body">
                                        <i data-feather="book" class="feather px-1" style="width: 150px; height: 150px"></i>
                                        <h4 class="card-title text-white mt-3">{{ __("DashboardInicio5") }}</h4>
                                        <p class="card-text"></p>
                                        <a href="/dashboard/cursos"><button class="btn btn-primary">{{ __("DashboardInicio13") }}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (auth()->user()->role_id === \App\Role::ADMIN)
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card text-white bg-gradient-primary text-center">
                                <div class="card-content d-flex">
                                    <div class="card-body">
                                        <i data-feather="award" class="feather px-1" style="width: 150px; height: 150px"></i>
                                        <h4 class="card-title text-white mt-3">{{ __("DashboardInicio6") }}</h4>
                                        <p class="card-text"></p>
                                        <a href="/dashboard/especialidades">
                                            <button class="btn btn-primary">{{ __("DashboardInicio13") }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (auth()->user()->role_id === \App\Role::ADMIN || auth()->user()->role_id === \App\Role::TEACHER)
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card text-white bg-gradient-primary text-center">
                                <div class="card-content d-flex">
                                    <div class="card-body">
                                        <i data-feather="file-text" class="feather px-1" style="width: 150px; height: 150px"></i>
                                        <h4 class="card-title text-white mt-3">{{ __("DashboardInicio3") }}</h4>
                                        <p class="card-text"></p>
                                        <a href="/dashboard/articulos">
                                            <button class="btn btn-primary">{{ __("DashboardInicio13") }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </section>
            <!-- Dashboard Analytics end -->
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@endsection