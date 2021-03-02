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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
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
                                                <span>{{DB::table('module_user')->where('user_id','=',Auth::user()->id)->join('module_course','module_user.module_id','=','module_course.module_id')->where('module_course.course_id','=',$course->id)->where('module_user.status','=','2')->count()}}/{{DB::table('module_course')->where('course_id','=',$course->id)->count()}}</span>
                                                <br>
                                            </p>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-4 col-xs-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    @if (Auth::guest())
                                                        <p class="white hidden-sm hidden-xs p-curso-curso" style="color: white !important;">{{ __("Curso2") }}</p>
                                                        <h2 class="h2-curso-curso"><b>10 USD</b></h2>
                                                        <a href="/planes"><input type="button" name="commit" value="{{ __("Curso3") }}" class="btn btn-bta" ></a>
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
                                                                    <a href="{{$course->slug}}/{{DB::table('module_course')->where('course_id','=',$course->id)->join('modules','module_course.module_id','=','modules.id')->first()->slug}}"><input type="button" name="commit" value="{{ __("Curso10") }}" class="f-main-btn premium-btn" style="cursor: pointer"></a>
                                                                @endif
                                                            @else
                                                                <input type="button" name="commit" value="{{ __("Curso10") }}" class="f-main-btn premium-btn" style="cursor: pointer;">
                                                            @endif
                                                        @endif
                                                    @endif
                                                    <br>
                                                    <!--<a href="/planes">-->
                                                    <input type="button" name="commit" value="{{ __("CursoBotonEstadisticas") }}" class="f-main-btn premium-btn estadisticasBtn" style="cursor: pointer; margin-top: 15px;">
                                                    <!--</a>-->
                                                    <a href="/dashboard/cursos/editar/{{ $course->id }}">
                                                        <input type="button" name="commit" value="{{ __("CursoBotonGestionarCurso") }}" class="f-main-btn premium-btn" style="cursor: pointer; margin-top: 15px;">
                                                    </a>
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
                                            {{ _("Curso8") }}
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

    <!-- BEGIN: ESTADISTICAS MODAL -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog" style="margin-left: 25%;">
            <div class="modal-content" style="width: 750px;">
                <div class="modal-header text-white" style="background-color: #0047FF;">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("TituloEstadisticasPopup") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- BEGIN: Gráfico Área - Usuarios Inscriptos Por Mes -->
                    <div id="graficaLineal" style="width: 100%; height: 500px; margin: 0 auto"></div>
                    <!-- END: Gráfico Área - Usuarios Inscriptos Por Mes -->

                    <br>
                    <hr style="height: 10px; border: 0; box-shadow: 0 10px 10px -10px #8c8b8b inset">
                    <br>

                    <!-- BEGIN: Gráfico Torta - Estado de los Distintos Modulos del Curso -->
                    <div id="graficoTorta" style="width: 100%; height: 500px; margin: 0 auto"></div>
                    <!-- END: Gráfico Torta - Estado de los Distintos Modulos del Curso -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("BotonCerrarEstadisticasPopup") }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: ESTADISTICAS MODAL -->

    <script>

        var chart;
        var datosGraficoArea = {!! json_encode(DB::select("SELECT COUNT(module_id) AS 'Usuarios', created_at AS 'Fecha' FROM module_course WHERE module_id = '1' GROUP BY course_id, created_at"))    !!};

        var arrUsuarios = new Array();
        var arrFecha = new Array();

        datosGraficoArea.forEach(function (value) {
            arrUsuarios.push(value.Usuarios);
            arrFecha.push(value.Fecha);
        });

        $(document).ready(function () {
            $(".estadisticasBtn").on("click", function () {
                $("#deleteModal").modal("show");
            });

            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'graficaLineal', 	// Le doy el nombre a la gráfica
                    defaultSeriesType: 'area'	// Pongo que tipo de gráfica es
                },
                title: {
                    text: 'Usuarios Inscriptos Por Mes'	// Titulo (Opcional)
                },
                // Pongo los datos en el eje de las 'X'
                xAxis: {
                    categories: arrFecha,
                    // Pongo el título para el eje de las 'X'
                    title: {
                        text: 'Meses'
                    }
                },
                yAxis: {
                    // Pongo el título para el eje de las 'Y'
                    title: {
                        text: 'Nº Usuarios'
                    }
                },
                // Doy formato al la "cajita" que sale al pasar el ratón por encima de la gráfica
                tooltip: {
                    enabled: true,
                    formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y +' '+this.series.name;
                    }
                },
                credits: {
                    enabled: false
                },
                // Doy opciones a la gráfica
                plotOptions: {
                    area: {
                        fillColor: '#54aa95',
                        lineColor: '#217762',
                        color: '#154a3d'
                    },
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                // Doy los datos de la gráfica para dibujarlas
                series: [{
                    name: 'Usuarios',
                    data: arrUsuarios
                }],
            });

        });
    </script>

    <script>

        var chart;
        var datosGraficoTorta = {!! json_encode(DB::select("SELECT modules.name AS 'name', count(module_user.module_id) AS 'y' FROM module_user INNER JOIN module_course ON module_user.module_id = module_course.module_id INNER JOIN modules ON module_user.module_id = modules.id WHERE module_user.status = '2' AND module_course.course_id = '".$course->id."' GROUP BY modules.name"))    !!};

        console.log(datosGraficoTorta);

        $(document).ready(function () {

            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'graficoTorta', 	// Le doy el nombre a la gráfica
                    defaultSeriesType: 'pie'	// Pongo que tipo de gráfica es
                },
                title: {
                    text: 'Módulos Completados'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Completados',
                    colorByPoint: true,
                    data: datosGraficoTorta
                }]
            });

        });
    </script>

@endsection