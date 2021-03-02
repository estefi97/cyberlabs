<html class="js-focus-visible" data-js-focus-visible="" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $Module->name }} | Cyberlabs</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('/js/hacktiva-module.js') }}" data-turbolinks-track="true"></script>
    <script data-dapp-detection="">
        (function() {
            let alreadyInsertedMetaTag = false

            function __insertDappDetected() {
                if (!alreadyInsertedMetaTag) {
                    const meta = document.createElement('meta')
                    meta.name = 'dapp-detected'
                    document.head.appendChild(meta)
                    alreadyInsertedMetaTag = true
                }
            }

            if (window.hasOwnProperty('web3')) {
                // Note a closure can't be used for this var because some sites like
                // www.wnyc.org do a second script execution via eval for some reason.
                window.__disableDappDetectionInsertion = true
                // Likely oldWeb3 is undefined and it has a property only because
                // we defined it. Some sites like wnyc.org are evaling all scripts
                // that exist again, so this is protection against multiple calls.
                if (window.web3 === undefined) {
                    return
                }
                __insertDappDetected()
            } else {
                var oldWeb3 = window.web3
                Object.defineProperty(window, 'web3', {
                    configurable: true,
                    set: function (val) {
                        if (!window.__disableDappDetectionInsertion)
                            __insertDappDetected()
                        oldWeb3 = val
                    },
                    get: function () {
                        if (!window.__disableDappDetectionInsertion)
                            __insertDappDetected()
                        return oldWeb3
                    }
                })
            }
        })()</script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style-hacktiva-module.css') }}" data-turbolinks-track="true">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/favicon-e8bea7a0071e296638a3a1a08be81f0a30b9c945625e5a200fefecd8d9b2ed6c.ico">
    <meta name="csrf-param" content="authenticity_token">
    <meta name="csrf-token" content="w3iyQzN0CS/YNchVzWUVXsHansyueZ5j5jmB1qihMMfDig+WSb8cDgksiRFgm/E55qbfFFP3oKAeenRi9ezMSg==">
    <style type="text/css">
        </style></head>
<body>

<div id="wrapper" class="active">


    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div style="margin-top: 25px; margin-bottom: 25px;" class="Logo">
            <a style="margin: auto;" href="/" aria-label="Home page">
                <img src="https://cyberlabs.test/images/logo_cyberlabs_white.png" >
            </a>
        </div>
        <ul class="sidebar-nav" id="sidebar">
            @php
            $cantidadModulosCursos = DB::table('module_course')->where('course_id','=',$Course->id)->get()->count();
            $modulos = DB::table('module_course')->where('course_id','=',$Course->id)->pluck('module_id')->toArray();
            @endphp
            @for($i=0; $i < $cantidadModulosCursos; $i++)
                <li><a @if($Module->id === $modulos[$i]) class="current" @endif href="/curso/{{ $Course->slug }}/{{ DB::table('modules')->where('id','=',$modulos[$i])->get()->first()->slug }}">{{ $i+1 }}. {{ DB::table('modules')->where('id','=',$modulos[$i])->get()->first()->name }}</a></li>
            @endfor
        </ul>
    </div>

    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
                <div class="col-md-6 lesson">

                    <div class="user-app">
                        <a class="btn btn-default btn-sm" href="/curso/{{ $Course->slug }}">
                            <i class="fa fa-arrow-circle-left"></i> {{ __("ModuloCursoVolverAlCurso") }}
                        </a>
                    </div>



                    <div class="lesson-content">
                        {!! $Module->content !!}
                    </div>
                </div>

                <div class="col-md-6 practice">
                    <div class="exercise-content">
                        <h3>{{ __("ModuloCursoDesafio") }}</h3>
                        {!! $Module->description_challenge !!}
                    </div>
                    <div class="quiz-content">
                        <h3>{{ __("ModuloCursoResolucionDesafio") }}</h3>
                        <p>{{ __("ModuloCursoResolucionDesafioDescripcion") }}</p>
                        <div class="course-actions">
                            <div id="check-answer"></div>
                            <form accept-charset="UTF-8" data-remote="true" method="get">
                                <input name="utf8" type="hidden" value="✓">
                                <input type="text" name="user_answer" id="user_answer" size="30" class="input-sm">
                                <input type="submit" id="type-success" name="commit" value="{{ __("ModuloCursoRevisarRespuesta") }}" class="btn btn-info btn-sm">
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div><!-- end of page content -->


</div><!-- end of wrapper -->

<!-- BEGIN: Page JS -->
<script src="{{ asset('/dash/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<!-- END: Page JS -->

<script>
    $(document).ready(optimizeMobile);
    $(window).on('resize', optimizeMobile);

    function optimizeMobile() {
        if (($(window).width() <= 767) || ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )){
            $("#wrapper").removeClass("active");
        } else {
            $("#wrapper").addClass("active");
        }
    }

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });

    $("#hint-toggle").click(function(e) {
        $("#hint").toggle();
    });
</script>

<script>
    $('#type-success').on('click', function () {
        let respuestaUsuario = document.getElementById('user_answer').value;
        let solutionChallenge = {!! json_encode($Module->solution_challenge) !!};
        let slugCurso = {!! json_encode($Course->slug) !!};
        let slugModulo = {!! json_encode($Module->slug) !!};
        let idModulo = {!! json_encode($Module->id) !!};
        let idUsuario = {!! json_encode(auth()->user()->id) !!};
        let token = $("meta[name='csrf-token']").attr("content");
        let data = {id_modulo_curso:idModulo,id_usuario:idUsuario,_token:token};
        if (respuestaUsuario === solutionChallenge) {
            $.ajax({
                type: 'POST',
                url: "{{ route('courses.module.completed', ['course' => $Course->slug, 'modulo' => $Module->slug]) }}",
                data: data,
                success: function (response) {
                    Swal.fire({
                        title: "Desafío Completado Exitosamente!",
                        text: "Has finalizado éste módulo!",
                        type: "success",
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    }).then(function () {
                        let modulosDelCurso = document.getElementById('sidebar').getElementsByTagName('li');
                        for (var i = 0; i < modulosDelCurso.length; i++) {
                            if (modulosDelCurso[i].getElementsByTagName('a')[0].classList.contains('current') === true) {
                                if (i < modulosDelCurso.length) {
                                    window.location = modulosDelCurso[i+1].getElementsByTagName('a')[0].getAttribute('href');
                                }
                            }
                        }
                    });
                }
            });
        } else {
            Swal.fire({
                title: "Has fallado!",
                text: "Intentalo nuevamente!",
                type: "error",
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
            });
        }
    });
</script>

</body>
</html>