@extends('layouts.app')
<title>{{ $specialty->name }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')

    <div class="main-container text-center f-padding-y lateral-card-container">
        <div class="row justify-content-md-center f-top" style="text-align: center;">
            <div class="text-center no-padding">
                <div class="box" style="text-align: center;margin: 0 auto;">
                    <h1 class="no-margin normal-line-height h1 f-text-36" style="text-align: center;">{{ $specialty->name }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="no-padding">
                <div class="box">
                    <div class="f-top">
                        <div class="f-padding-large f-border f-shadow f-bottom f-radius" style="margint:auto 5px">
                            <div class="row middle-xs">
                                <div class="right-space">
                                    <span style="font-size:36px">💡</span>
                                </div>
                                <div class="col-xs no-padding">
                                    <div class="box">
                                        <p class="no-margin">{{ __("EspecialidadTituloExplicativo") }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $auxContadorModulos = 0;
                    @endphp
                    @if ($specialty->courses()->count() > 0)
                        <p class="f-top-bigger no-margin h2 rb-normal text-center" style="margin-top: 100px !important; font-size: 24px !important;">
                            {{ __("EspecialidadIniciaAqui") }}</p>
                        <div class="f-course-paths text-center">
                            <div class="circle small-circle f-inverse h2 rb-normal center-vertical-horizontal center-block linear-item" style="margin-top: 15px !important; margin-bottom: 0 !important;">1</div>
                            <div class="vertical-line"></div>
                            @for($i=0; $i < 1; $i++)
                                @php
                                    $auxContadorModulos = $auxContadorModulos + 1;
                                @endphp
                                <a href="/curso/{{ $specialty->courses[$i]->slug }}">
                                    <div class="center-block f-card f-course-with-avatar overflow-hidden">
                                        <div class="avatar-container relative f-padding-x-intersection" style="background-image:url(https://cyberlabs.test/images/courses/{{ $specialty->courses[$i]->picture }});background-size: cover; min-height:130px">
                                            <div class="absolute full-width full-height avatar avatar-background"></div>
                                        </div>
                                        <div class="f-padding-x-intersection description f-padding-y">
                                            <div class="box full-width text-left">
                                                <div class="row" style="margin-top:10px;">
                                                    <div class="col-xs no-padding">
                                                        <div class="box">
                                                            <p class="bold no-margin" style="font-size: 20px; color: black;">{{ $specialty->courses[$i]->name }}</p>
                                                            <div class="row middle-xs" style="column-gap:0px; margin-top: 10px;">
                                                                <div class="circle f-border f-premium-text f-right-space-char" style="background-image:url(/images/users/{{ DB::table('users')->select('picture')->where('id','=',$specialty->courses[$i]->id)->first()->picture }});background-size:cover;background-position:center;width:24px;height:24px; margin:0 auto; margin-right: 10px; margin-left: 1px;"></div>
                                                                <p class="no-margin f-label f-grey-text col-xs text-left" style="font-size: 14px;">{{ DB::table('users')->select('name')->where('id','=',$specialty->courses[$i]->id)->first()->name.' '.DB::table('users')->select('last_name')->where('id','=',$specialty->courses[$i]->id)->first()->last_name }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="top-space f-grey-text h7">
                                                    <p class="no-margin" style="color: black !important;">{{ $specialty->courses[$i]->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endfor
                            @if ($specialty->courses()->count() === 1)
                                <div class="vertical-line-large"></div>
                                <div class="normal-svg fill-svg f-success-text linear-item" style="margin-top: 0 !important; height:120px; margin-bottom: 35px;">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" style="height: 120px;" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-650.9 1340.4 43.8 43.8" style="enable-background:new -650.9 1340.4 43.8 43.8;" xml:space="preserve">
                                <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                                    <g>
                                        <g id="Layer0_0_FILL">
                                            <path class="checkmark_bg" d="M-607.1,1362.3c0-6.1-2.1-11.2-6.4-15.5c-4.3-4.3-9.5-6.4-15.5-6.4c-6.1,0-11.2,2.1-15.5,6.4
					c-4.3,4.3-6.4,9.4-6.4,15.5c0,6,2.1,11.2,6.4,15.5c4.3,4.3,9.4,6.4,15.5,6.4c6,0,11.2-2.1,15.5-6.4
					C-609.2,1373.5-607.1,1368.3-607.1,1362.3 M-620.7,1353.9l3.8,3.4l-14.5,16.3l-9.8-8.9l3.4-3.8l6,5.5L-620.7,1353.9z"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                                </div>
                                <p class="h2 rb-normal">{{ __("EspecialidadFin") }}</p>
                            @endif
                            @if ($specialty->courses()->count() >= 2)
                                @for($i=1; $i < $specialty->courses()->count(); $i++)
                                    @php
                                        $auxContadorModulos = $i + 1;
                                    @endphp
                                    <div class="vertical-line-large"></div>
                                    <div class="circle small-circle f-inverse h2 rb-normal center-vertical-horizontal center-block linear-item" style="margin-bottom: 0 !important;">{{ $auxContadorModulos }}</div>
                                    <div class="vertical-line"></div>
                                    <a href="/curso/{{ $specialty->courses[$i]->slug }}">
                                        <div class="center-block f-card f-course-with-avatar overflow-hidden">
                                            <div class="avatar-container relative f-padding-x-intersection" style="background-image:url(https://cyberlabs.test/images/courses/{{ $specialty->courses[$i]->picture }});background-size: cover; min-height:130px">
                                                <div class="absolute full-width full-height avatar avatar-background"></div>
                                            </div>
                                            <div class="f-padding-x-intersection description f-padding-y">
                                                <div class="box full-width text-left">
                                                    <div class="row" style="margin-top:10px;">
                                                        <div class="col-xs no-padding">
                                                            <div class="box">
                                                                <p class="bold no-margin" style="font-size: 20px; color: black;">{{ $specialty->courses[$i]->name }}</p>
                                                                <div class="row middle-xs" style="column-gap:0px; margin-top: 10px;">
                                                                    <div class="circle f-border f-premium-text f-right-space-char" style="background-image:url(/images/users/{{ DB::table('users')->select('picture')->where('id','=',$specialty->courses[$i]->id)->first()->picture }});background-size:cover;background-position:center;width:24px;height:24px; margin:0 auto; margin-right: 10px; margin-left: 1px;"></div>
                                                                    <p class="no-margin f-label f-grey-text col-xs text-left" style="font-size: 14px;">{{ DB::table('users')->select('name')->where('id','=',$specialty->courses[$i]->id)->first()->name.' '.DB::table('users')->select('last_name')->where('id','=',$specialty->courses[$i]->id)->first()->last_name }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top-space f-grey-text h7">
                                                        <p class="no-margin" style="color: black !important;">{{ $specialty->courses[$i]->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endfor
                                    <div class="vertical-line-large"></div>
                                    <div class="normal-svg fill-svg f-success-text linear-item" style="margin-top: 0 !important; height:120px; margin-bottom: 35px;">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" style="height: 120px;" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-650.9 1340.4 43.8 43.8" style="enable-background:new -650.9 1340.4 43.8 43.8;" xml:space="preserve">
                                <g transform="matrix( 1, 0, 0, 1, 0,0) ">
                                    <g>
                                        <g id="Layer0_0_FILL">
                                            <path class="checkmark_bg" d="M-607.1,1362.3c0-6.1-2.1-11.2-6.4-15.5c-4.3-4.3-9.5-6.4-15.5-6.4c-6.1,0-11.2,2.1-15.5,6.4
					c-4.3,4.3-6.4,9.4-6.4,15.5c0,6,2.1,11.2,6.4,15.5c4.3,4.3,9.4,6.4,15.5,6.4c6,0,11.2-2.1,15.5-6.4
					C-609.2,1373.5-607.1,1368.3-607.1,1362.3 M-620.7,1353.9l3.8,3.4l-14.5,16.3l-9.8-8.9l3.4-3.8l6,5.5L-620.7,1353.9z"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                                    </div>
                                    <p class="h2 rb-normal">{{ __("EspecialidadFin") }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection