@extends('layouts.app')
<title>{{ $course->name }} | Hacktiva</title>
<style>
    body {
        background-color: white !important;
        color: black !important;
    }
    .h3-curso-curso {
        color: black !important;
    }
    .p-curso-curso {
        color: black !important;
    }
    .body-bta {
        color: black !important;
    }
</style>
@section('content')
    <div class="wrapper ">
        <div class="content">
            <div class="padding-top">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                            <br>
                            <div class="img-wrap-course" style="border-radius: 50px !important; overflow: hidden !important;">
                                <img class="img-img hidden-xs" src="{{ $course->pathAttachment() }}" alt="{{ $course->name }}">
                                <div class="img-position img-description-big">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-7 col-sm-8 col-xs-12 text-left">
                                            <p class="hidden-sm p-curso-curso" style="color: white !important;">{{ __("Curso1") }}</p>
                                            <h1 class="h1-curso-curso"><b>{{ $course->name }}</b></h1>
                                            <p class="white p-curso-descripcion">
                                                <span><b><i class="fa fa-clock-o"></i></b></span>
                                                <span class="padding-right-8">01:40:01</span>
                                                <span><b><i class="fa fa-graduation-cap"></i></b></span>
                                                <span class="padding-right-8">{{ $course->level->name }}</span>
                                                <span><i class="fa fa-play"></i> </span>
                                                @if (Auth::guest())
                                                    <span>0/{{DB::table('module_course')->where('course_id','=',$course->id)->count()}}</span>
                                                @else
                                                    <span>{{DB::table('module_user')->where('user_id','=',Auth::user()->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->id)->where('module_user.status','=','2')->count()}}/{{DB::table('module_course')->where('course_id','=',$course->id)->count()}}</span>
                                                @endif
                                                <br>
                                                <!--<a href="#">{{ $course->teacher->user->name }}</a>-->
                                            </p>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-4 col-xs-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    @if (Auth::guest())
                                                        <p class="white hidden-sm hidden-xs p-curso-curso" style="color: white !important;">{{ __("Curso2") }}</p>
                                                        <h2 class="h2-curso-curso"><b>10 USD</b></h2>
                                                        <a href="/planes"><input type="button" name="commit" value="{{ __("Curso3") }}" class="f-main-btn premium-btn" style="cursor: pointer;"></a>
                                                    @else
                                                        @if (DB::table('subscriptions')->where([['user_id','=',Auth::user()->id],['ends_at','>',\Carbon\Carbon::Now()]])->count() === 0)
                                                            <p class="white hidden-sm hidden-xs p-curso-curso" style="color: white !important;">{{ __("Curso2") }}</p>
                                                            <h2 class="h2-curso-curso"><b>10 USD</b></h2>
                                                            <a href="/planes"><input type="button" name="commit" value="{{ __("Curso3") }}" class="f-main-btn premium-btn" style="cursor: pointer;"></a>
                                                        @else
                                                            @if (DB::table('module_course')->where('course_id','=',$course->id)->count() > 0)
                                                                @if (DB::table('module_user')->where([['module_id','=',DB::table('module_course')->where('course_id','=',$course->id)->join('modules','module_course.module_id','=','modules.id')->first()->id],['user_id','=',Auth::user()->id]])->count() === 0)
                                                                    <a href="inscripcion-curso/{{$course->id}}/{{Auth::user()->id}}"><input type="button" name="commit" value="{{ __("Curso10") }}" class="f-main-btn premium-btn" style="cursor: pointer;"></a>
                                                                @else
                                                                    <a href="{{$course->slug}}/{{DB::table('module_course')->where('course_id','=',$course->id)->join('modules','module_course.module_id','=','modules.id')->first()->slug}}"><input type="button" name="commit" value="{{ __("Curso10") }}" class="f-main-btn premium-btn" style="cursor: pointer;"></a>
                                                                @endif
                                                            @else
                                                                <input type="button" name="commit" value="{{ __("Curso10") }}" class="f-main-btn premium-btn" style="cursor: pointer;">
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="h3-curso-curso"><b>{{ __("Curso4") }}</b></h3>
                                    <p class="body-bta text-justify padding-left-25" style="color: black !important;">{{ $course->description }}</p>
                                    <h3 class="h3-curso-curso"><b>{{ __("Curso5") }}</b></h3>
                                    @forelse($course->goals as $goal)
                                    <p class="padding-left-25 p-curso-curso" style="color: black !important;">
                                        <i class="fa fa-check primary-color-especialidades" style="color: #0047ff !important"></i> {{ $goal['goal'] }}
                                    </p>
                                    @empty
                                        <p class="body-bta text-justify padding-left-25 p-curso-curso" style="color: black !important;">
                                            {{ __("Curso6") }}
                                        </p>
                                    @endforelse
                                    <h3 class="h3-curso-curso"><b>{{ __("Curso7") }}</b></h3>
                                    @forelse($course->requirements as $requirement)
                                        <p class="padding-left-25 p-curso-curso" style="color: black !important;">
                                            <i class="fa fa-check primary-color-especialidades" style="color: #0047ff !important"></i> {{ $requirement['requirement'] }}
                                        </p>
                                    @empty
                                        <p class="body-bta text-justify padding-left-25 p-curso-curso" style="color: black !important;">
                                            {{ __("Curso8") }}
                                        </p>
                                    @endforelse
                                    <h3 class="h3-curso-curso"><b>{{ __("Curso9") }}</b></h3>

                                    @php
                                    $i = 0;
                                    @endphp

                                    @forelse($course->modules as $module)
                                        @php
                                        $i = $i + 1;
                                        @endphp
                                        @if (Auth::guest())
                                            <a class="a-curso-curso" href="/planes">
                                                <p class="row-video-not-viewed">
                                                    <i class="fa fa-lock color-gray"></i>
                                                    {{ $i.'. ' }}{{ $module->name }}
                                                    <normal class="pull-right hidden-xs">
                                                        <i class="fa fa-arrow-right primary-color-especialidades" style="color: #0047ff !important; margin-top: 5px !important;"></i>
                                                    </normal>
                                                </p>
                                            </a>
                                        @else
                                            @if (DB::table('subscriptions')->where([['user_id','=',Auth::user()->id],['ends_at','>',\Carbon\Carbon::Now()]])->count() === 0)
                                                <a class="a-curso-curso" href="/planes">
                                                    <p class="row-video-not-viewed">
                                                        <i class="fa fa-lock color-gray"></i>
                                                        {{ $i.'. ' }}{{ $module->name }}
                                                        <normal class="pull-right hidden-xs">
                                                            <i class="fa fa-arrow-right primary-color-especialidades" style="color: #0047ff !important; margin-top: 5px !important;"></i>
                                                        </normal>
                                                    </p>
                                                </a>
                                            @else
                                                @if (DB::table('module_user')->where([['module_id','=',$module->id],['user_id','=',Auth::user()->id]])->count() === 0)
                                                    <a class="a-curso-curso" href="inscripcion-curso/{{$course->id}}/{{Auth::user()->id}}">
                                                        <p class="row-video-not-viewed">
                                                            <i class="fa fa-lock color-gray"></i>
                                                            {{ $i.'. ' }}{{ $module->name }}
                                                            <normal class="pull-right hidden-xs">
                                                                <i class="fa fa-arrow-right primary-color-especialidades" style="color: #0047ff !important; margin-top: 5px !important;"></i>
                                                            </normal>
                                                        </p>
                                                    </a>
                                                @else
                                                    @if ($module->status($module) instanceof App\State\ModuleNotCompletedState)
                                                    <a class="a-curso-curso" href="{{ $course->slug }}/{{ $module->slug }}">
                                                        <p class="row-video-not-viewed">
                                                            <i class="fa fa-lock color-gray"></i>
                                                            {{ $i.'. ' }}{{ $module->name }}
                                                            <normal class="pull-right hidden-xs">
                                                                <i class="fa fa-arrow-right primary-color-especialidades" style="color: #0047ff !important; margin-top: 5px !important;"></i>
                                                            </normal>
                                                        </p>
                                                    </a>
                                                    @else
                                                        <a class="a-curso-curso" href="{{ $course->slug }}/{{ $module->slug }}">
                                                            <p class="row-video-not-viewed">
                                                                <i class="fa fa-check primary-color-especialidades" style="color: #0047ff !important;"></i>
                                                                {{ $i.'. ' }}{{ $module->name }}
                                                                <normal class="pull-right hidden-xs">
                                                                    <i class="fa fa-arrow-right primary-color-especialidades" style="color: #0047ff !important; margin-top: 5px !important;"></i>
                                                                </normal>
                                                            </p>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @empty

                                    @endforelse

                                </div>
                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection