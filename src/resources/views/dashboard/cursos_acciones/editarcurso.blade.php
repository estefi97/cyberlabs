@extends('dashboard.partials.content')
<title>{{ __("dashboardEditarCurso1") }} | Hacktiva</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/editors/quill/katex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/editors/quill/quill.bubble.css') }}">
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ __("dashboardEditarCurso1") }}</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">{{ __("DashboardComentarios3") }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/dashboard/cursos">{{ __("dashboardEditarCurso2") }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ __("dashboardEditarCurso1") }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit account form start -->
                                        <form action="{{ route('dashboard_cursos.editar') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso3") }}</label>
                                                            <input name="titulo" id="titulo" value="{{ $course->name }}" placeholder="{{ __("dashboardEditarCurso4") }}" type="text" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso5") }}</label>
                                                            @if($course->picture)
                                                                <br>
                                                                <img style="width: 150px; height: 150px;" src="{{ $course->pathAttachment() }}">
                                                                <br>
                                                            @endif
                                                            <br>
                                                            <input type="file" id="myFile" name="picture">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso6") }}</label>
                                                            <select name="profesorSeleccionado" class="form-control" id="basicSelect" required>
                                                                @foreach(DB::table('users')->where('role_id','=','2')->select('id','name','last_name')->get() as $user)
                                                                    <option value="{{ $user->id }}" @if($course->teacher_id === $user->id) {{ __("selected") }} @endif>{{ $user->name.' '.$user->last_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso7") }}</label>
                                                            <select name="categoriaSeleccionada" class="form-control" id="basicSelect">
                                                                @foreach(DB::table('categories')->select('id','name')->get() as $category)
                                                                    <option value="{{ $category->id }}" @if($course->category_id === $category->id) {{ __("selected") }} @endif>{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>-->
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso8") }}</label>
                                                            <select name="nivelSeleccionado" class="form-control" id="basicSelect" required>
                                                                @foreach(DB::table('levels')->select('id','name')->get() as $level)
                                                                    <option value="{{ $level->id }}" @if($course->level_id === $level->id) {{ __("selected") }} @endif>{{ $level->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso9") }}</label>
                                                            <select name="estadoSeleccionado" class="form-control" id="basicSelect" required>
                                                                <option value="1" @if($course->status === "1") {{ __("selected") }} @endif>
                                                                    {{ __("dashboardEditarCurso10") }}</option>
                                                                <option value="2" @if($course->status === "3") {{ __("selected") }} @endif>
                                                                    {{ __("dashboardEditarCurso11") }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso12") }}</label>
                                                            <textarea style="resize: none;" name="descripcion" id="descripcion" placeholder="{{ __("dashboardEditarCurso13") }}" autocomplete="off" class="form-control" required>{{ $course->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso14") }}</label>
                                                            <textarea style="resize: none;" name="metas" id="metas" placeholder="{{ __("dashboardEditarCurso15") }}: ' || '" autocomplete="off" class="form-control" required>@foreach($course->goals as $goal) {{ $goal['goal'] }} @endforeach</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">{{ __("dashboardEditarCurso16") }}</label>
                                                            <textarea style="resize: none;" name="requisitos" id="requisitos" placeholder="{{ __("dashboardEditarCurso17") }}: ' || '" autocomplete="off" class="form-control" required>@foreach($course->requirements as $requirement) {{ $requirement['requirement'] }} @endforeach</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <input type="hidden" name="idCurso" value="{{ $course->id }}">
                                                    <button name="insertData" type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" id="type-success">
                                                        {{ __("dashboardEditarCurso18") }}</button>
                                                    <button type="reset" class="btn btn-outline-warning" id="botonCancelar">
                                                        {{ __("dashboardEditarCurso19") }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
            </div>
        </div>
    </div>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/dash/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/dash/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/dash/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/dash/app-assets/js/scripts/pages/app-user.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/scripts/navs/navs.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/scripts/extensions/toastr.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/dash/app-assets/js/scripts/ui/cursos/data-list-view.js') }}"></script>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
    <script>
        $('#type-success').on('click', function () {
            Swal.fire({
                title: "Curso Modificado!",
                text: "Se han guardado los cambios con éxito!",
                type: "success",
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
            });
        });
    </script>
    <!-- END: Page JS-->

    <!-- BEGIN: Modificaciones Menu -->
    <script>
        let menuInicio = document.getElementById('menuInicio');
        let menuCursos = document.getElementById('menuCursos');
        menuInicio.classList.remove('active');
        menuCursos.classList.add('active');
    </script>
    <!-- END: Modificaciones Menu -->
@endsection