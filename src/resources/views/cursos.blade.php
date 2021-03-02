@extends('layouts.app')
<title>{{ __("CursosPagina") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
    <h1 class="f-top FeatureTitle FeatureTitle--Centered FeatureTitle--AlwaysVisible">
        <span style="color: black;">{{ __("CursosPagina1") }}</span> <span style="color: #0047FF;">{{ __("CursosPagina2") }}</span> <span style="color: black;">-</span> <span class="CompanyName" style="color: black;">CYBERLABS</span>
    </h1>
    <div class="f-top">
        @forelse($courses as $course)
            <div style="max-width: 1100px; margin: 0 auto; margin-top: 10px;">
                <div class="courses-main-area relative">
                    <div class="text-left" id="courses-section">
                        <a href="/curso/{{ $course->slug }}">
                            <div class="f-card f-course-with-avatar overflow-hidden">
                                <div class="avatar-container relative f-padding-x-intersection" style="background-image:url({{ $course->pathAttachment() }});background-size: cover; min-height:130px">
                                    <div class="absolute full-width full-height avatar avatar-background"></div>
                                </div>
                                <div class="f-padding-x-intersection description f-padding-y">
                                    <div class="box full-width text-left">
                                        <div class="row">
                                            <div class="col-xs no-padding">
                                                <div class="box">
                                                    <p class="bold no-margin" style="font-size: 20px; color: black;">{{ $course->name }}</p>
                                                    <div class="row middle-xs" style="column-gap:0px; margin-top: 10px;">
                                                        <div class="circle f-border f-premium-text f-right-space-char" style="background-image:url(/images/users/{{ DB::table('users')->select('picture')->where('id','=',$course->teacher->user_id)->first()->picture }});background-size:cover;background-position:center;width:24px;height:24px; margin:0 auto; margin-right: 10px; margin-left: 1px;"></div>
                                                        <p class="no-margin f-label f-grey-text col-xs text-left">{{ DB::table('users')->select('name')->where('id','=',$course->teacher->user_id)->first()->name.' '.DB::table('users')->select('last_name')->where('id','=',$course->teacher->user_id)->first()->last_name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="top-space f-grey-text h7">
                                            <p class="no-margin" style="color: black;">{{ $course->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            </div>
        </div>
        @empty
            <div class="alert alert-dark">
                {{ __("CursosPagina3") }}
            </div>
        @endforelse
        <div class="row justify-content-center mt-5">
            {{ $courses->links() }}
        </div>
    </div>
@endsection