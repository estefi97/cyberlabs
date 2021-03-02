@extends('layouts.app')
<title>{{ __("EspecialidadesPagina") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
    <h1 class="f-top FeatureTitle FeatureTitle--Centered FeatureTitle--AlwaysVisible">
        <span style="color: black;">{{ __("Especialidades1") }}</span> <span style="color: #0047FF;">{{ __("Especialidades2") }}</span> <span style="color: black;">-</span> <span class="CompanyName" style="color: black;">CYBERLABS</span>
    </h1>
    <div class="f-top">
        @forelse($specialties as $specialty)
            <div style="max-width: 1100px; margin: 0 auto; margin-top: 10px;">
                <div class="courses-main-area relative">
                    <div class="text-left" id="courses-section">
                        <a href="/especialidad/{{ $specialty->slug }}">
                            <div class="f-card f-course-with-avatar overflow-hidden">
                                <div class="avatar-container relative f-padding-x-intersection" style="background-image:url({{ $specialty->pathAttachment() }});background-size: cover; min-height:130px">
                                    <div class="absolute full-width full-height avatar avatar-background"></div>
                                </div>
                                <div class="f-padding-x-intersection description f-padding-y">
                                    <div class="box full-width text-left">
                                        <div class="row">
                                            <div class="col-xs no-padding">
                                                <div class="box">
                                                    <p class="bold no-margin" style="color: black; font-size: 20px;">{{ $specialty->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="top-space f-grey-text h7">
                                            <p class="no-margin" style="color: black;">{{ $specialty->description }}</p>
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
    </div>
@endsection