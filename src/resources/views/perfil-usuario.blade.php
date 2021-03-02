@extends('layouts.app')
<title>{{$user->name}} {{$user->last_name}} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
<link rel="stylesheet" href="{{ asset('css/editar-perfil.css') }}">
<main>
    <div class="f-space-medium-y">
        <div class="main-grid middle-xs content-grid" style="display: block;">
            <div class="circle inline-block border green-flat-text" style="float: left; background-image:url({{ $user->pathAttachment() }});background-size:cover;background-position:center;width:170px;height:170px;margin:0 auto;border: solid 3px currentColor !important;"></div>
            <div class="element col-2-3">
                <p class="no-margin h1" style="font-size: 24px !important; font-weight: 700 !important; float: left; margin-top: 70px !important; margin-left: 50px !important">{{$user->name}} {{$user->last_name}} <br><span style="font-size: 14px !important;">{{'@'.$user->name}}{{$user->last_name}}, {{$user->role->name}} {{ __("ViewProfile1") }} Cyberlabs</span></p>
                <div>
                </div>
                <p class="f-grey-text"></p>
            </div>
            <div class="element col-4-5 text-center row no-margin-right f-top-medium-xs">
                <div class=" col-xs-6 col-sm-12" style="margin-top: 35px;">
                    <div class="box" style="float: right;">
                        <p class="no-margin h2">{{ DB::table('module_user')->join('module_course','module_course.module_id','=','module_user.module_id')->select('module_user.module_id','module_user.user_id','module_course.course_id')->groupBy('module_course.course_id')->where('module_user.user_id','=',$user->id)->get()->count() }}</p>
                        <p class="f-label f-premium-text no-margin" style="font-weight: bold;">{{ __("ViewProfile2") }}</p>
                    </div>
                    <div class="box" style="float: right; margin-right: 10px;">
                        <p class="no-margin h2">{{ DB::table('module_user')->where('user_id','=',$user->id)->where('status','=','2')->count() }} / {{DB::table('module_user')->where('user_id','=',$user->id)->count()}}</p>
                        <p class="f-label f-premium-text no-margin" style="font-weight: bold;">{{ __("ViewProfile3") }}</p>
                    </div>
                </div>
                <div class=" col-xs-6 col-sm-12">
                    <div class="box" style="float: right; margin-top: 10px; margin-right: 9px;">
                        <p class="no-margin h2">{{ DB::table('comment_user')->where('user_id','=',$user->id)->count() }}</p>
                        <p class="f-label f-premium-text no-margin" style="font-weight: bold;">{{ __("ViewProfile4") }}</p>
                    </div>
                    <div class="box" style="float: right; margin-right: 25px; margin-top: 10px;">
                        <p class="no-margin h2">{{ DB::table('article_user')->join('articles','articles.id','=','article_user.article_id')->where('articles.status','=','1')->where('user_id','=',$user->id)->count() }}</p>
                        <p class="f-label f-premium-text no-margin" style="font-weight: bold;">{{ __("ViewProfile5") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="f-light f-top-big" style="padding-top:1px;padding-bottom:50px;">
        <div class="text-center circle center-vertical-horizontal center-block f-light" style="width:100px;height:100px;margin-top:-50px">
            <div class="normal-svg" style="height:48px">

                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 31 47" style="enable-background:new 0 0 31 47;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#F8CD5B;}
    .st1{fill:none;stroke:#21225B;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;}
    .st2{fill:#5BCC85;stroke:#21225B;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;}
</style>
                    <path class="st0" d="M7.9,27.3L5.5,45.5l10-6l10,6l-2.4-18.2"></path>
                    <path class="st1" d="M7.9,27.3L5.5,45.5l10-6l10,6l-2.4-18.2"></path>
                    <path class="st2" d="M15.5,29.5c7.7,0,14-6.3,14-14c0-7.7-6.3-14-14-14s-14,6.3-14,14C1.5,23.2,7.8,29.5,15.5,29.5z"></path>
</svg>
            </div>
        </div>
        <div class="main-container">
            <div class="f-top">
                <h2 class="h1 normal-line-height text-center">Cursos Realizados Recientemente:</h2>
            </div>
            <div class="f-top">
                <div class="row">
                    @forelse(DB::table('module_user')->join('module_course','module_course.module_id','=','module_user.module_id')->select('module_user.module_id','module_user.user_id','module_course.course_id')->groupBy('module_course.course_id')->where('module_user.user_id','=',$user->id)->get() as $course)
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="f-card">
                                <div class="f-padding-x-intersection f-padding-y">
                                    <h4 class="media-heading" style="margin-bottom: 18px; font-size: 18px; font-weight: 700!important;">{{ DB::table('courses')->where('id','=',$course->course_id)->first()->name }}</h4>
                                    <p>Progreso</p>
                                    <div class="progress" style="height: 16px; background-color:#1c1c29; font-size: 15px; margin-top: 5px;">
                                        @if(DB::table('module_user')->where('user_id','=',$user->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->course_id)->where('module_user.status','=','2')->count() > 0)
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{number_format(((DB::table('module_user')->where('user_id','=',$user->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->course_id)->where('module_user.status','=','2')->count() / DB::table('module_course')->where('course_id','=',$course->course_id)->count()) * 100),0,'.',',')}}%; background-color: #0047FF; font-weight: 760;" title="{{number_format(((DB::table('module_user')->where('user_id','=',$user->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->course_id)->where('module_user.status','=','2')->count() / DB::table('module_course')->where('course_id','=',$course->course_id)->count()) * 100),0,'.',',')}} %">
                                                {{number_format(((DB::table('module_user')->where('user_id','=',$user->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->course_id)->where('module_user.status','=','2')->count() / DB::table('module_course')->where('course_id','=',$course->course_id)->count()) * 100),0,'.',',')}} %
                                            </div>
                                        @else
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 15%; background-color: #35bb9a; font-weight: 760;" title="0 %">
                                                0 %
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
</main>
<!-- <div class="wrapper ">

    <div class="content">
        <div class="padding-top">
            <link rel="stylesheet" media="screen" href="https://d2sf9uby9ru2fk.cloudfront.net/assets/bootstrap/media-5644add624aa08792c074383b369225e2deabb210ae49308abac2859bd131360.css">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="row padding-small-top">
                            <div class="col-lg-2 col-md-3 col-xs-4 text-center">
                                <div class="text-center">
                                    <img style="max-width: 100px; max-height: 100px;" class="avatar-circle-profile" src="{{ $user->pathAttachment() }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-8" style="margin-left: -24px; margin-top: 20px;">
                                <h2 class="title-22px" style="font-weight: 760;">
                                    {{$user->name}} {{$user->last_name}}
                                    <div class="pull-right">
                                    </div>
                                </h2>
                                {{'@'.$user->name}}{{$user->last_name}}, {{$user->role->name}} en Hacktiva <br>
                            </div>
                        </div>
                        <br>
                        <div class="row text-center stat">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="well">
                                    <h2 style="font-weight: 760;">{{ DB::table('module_user')->join('module_course','module_course.module_id','=','module_user.module_id')->select('module_user.module_id','module_user.user_id','module_course.course_id')->groupBy('module_course.course_id')->get()->count() }}</h2>
                                    <p style="font-weight: 760;">Cursos Inscripto</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="well">
                                    <h2 style="font-weight: 760;">{{ DB::table('module_user')->where('user_id','=',$user->id)->where('status','=','2')->count() }} / {{DB::table('module_user')->where('user_id','=',$user->id)->count()}}</h2>
                                    <p style="font-weight: 760;">Módulos Completados</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="well">
                                    <h2 style="font-weight: 760;">{{ DB::table('article_user')->join('articles','articles.id','=','article_user.article_id')->where('articles.status','=','1')->where('user_id','=',$user->id)->count() }}</h2>
                                    <p style="font-weight: 760;">Artículos Redactados</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="well">
                                    <h2 style="font-weight: 760;">{{ DB::table('comment_user')->where('user_id','=',$user->id)->count() }}</h2>
                                    <p style="font-weight: 760;">Comentarios</p>
                                </div>
                            </div>
                        </div>
                        <p>
                        </p>
                        <div class="row">
                        </div>
                        <h3 class="title-secundary-description" style="margin-top: 15px; margin-bottom: 25px; font-size: 21px; font-weight: 760;">Cursos Realizados Recientemente</h3>
                        <div class="row">
                            @forelse(DB::table('module_user')->join('module_course','module_course.module_id','=','module_user.module_id')->select('module_user.module_id','module_user.user_id','module_course.course_id')->groupBy('module_course.course_id')->get() as $course)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="well">
                                        <div class="media-body" style="border: none; margin-bottom: 0; height: 80px;">
                                            <h4 class="media-heading" style="margin-bottom: 18px; font-size: 18px;">{{ DB::table('courses')->where('id','=',$course->course_id)->first()->name }}</h4>
                                            <p>Progreso</p>
                                            <div class="progress" style="height: 16px; background-color:#1c1c29; font-size: 15px; margin-top: 5px;">
                                                @if(DB::table('module_user')->where('user_id','=',$user->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->course_id)->where('module_user.status','=','2')->count() > 0)
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{number_format(((DB::table('module_user')->where('user_id','=',$user->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->course_id)->where('module_user.status','=','2')->count() / DB::table('module_course')->where('course_id','=',$course->course_id)->count()) * 100),0,'.',',')}}%; background-color: #35bb9a; font-weight: 760;" title="{{number_format(((DB::table('module_user')->where('user_id','=',$user->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->course_id)->where('module_user.status','=','2')->count() / DB::table('module_course')->where('course_id','=',$course->course_id)->count()) * 100),0,'.',',')}} %">
                                                    {{number_format(((DB::table('module_user')->where('user_id','=',$user->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->course_id)->where('module_user.status','=','2')->count() / DB::table('module_course')->where('course_id','=',$course->course_id)->count()) * 100),0,'.',',')}} %
                                                </div>
                                                @else
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 15%; background-color: #35bb9a; font-weight: 760;" title="0 %">
                                                        0 %
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection