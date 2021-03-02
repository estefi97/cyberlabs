@extends('dashboard.partials.content')
<title>Agregar Especialidad | Hacktiva</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/editors/quill/katex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/editors/quill/quill.bubble.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/forms/select/select2.min.css') }}">
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Agregar Especialidad</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">{{ __("DashboardComentarios3") }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/dashboard/especialidades">{{ __("DashboardComentarios1") }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Agregar Especialidad
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
                                        <form action="{{ route('dashboard_especialidades.agregar') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Nombre</label>
                                                            <input name="nombreEspecialidad" id="nombreEspecialidad" placeholder="Ingrese el Nombre de la Especialidad" type="text" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Cargar Imágen/Banner de la Especialidad</label>
                                                            <br>
                                                            <input type="file" id="imagenEspecialidad" name="imagenEspecialidad">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Nivel</label>
                                                            <select name="nivelEspecialidad" class="form-control" id="basicSelect">
                                                                @foreach(DB::table('levels')->select('id','name')->get() as $level)
                                                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Estado</label>
                                                            <select name="estadoEspecialidad" class="form-control" id="basicSelect">
                                                                <option value="1">ACTIVO</option>
                                                                <option value="2">NO ACTIVO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Cursos Asociados</label>
                                                            <select name="cursosAsociadosEspecialidad[]" class="select2 form-control" multiple="multiple">
                                                                @foreach(DB::table('courses')->select('id','name')->get() as $course)
                                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Descripción</label>
                                                            <textarea style="resize: none;" name="descripcionEspecialidad" id="descripcionEspecialidad" placeholder="Ingrese la Descripción de la Especialidad" autocomplete="off" class="form-control" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button name="insertData" type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" id="type-success">Guardar Cambios</button>
                                                    <button type="reset" class="btn btn-outline-warning" id="botonCancelar">Cancelar</button>
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
    <script src="{{ asset('/dash/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/scripts/ui/cursos/data-list-view.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
    <script>
        $('#type-success').on('click', function () {
            Swal.fire({
                title: "Especialidad Agregada!",
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
        let menuEspecialidades = document.getElementById('menuEspecialidades');
        menuInicio.classList.remove('active');
        menuEspecialidades.classList.add('active');
    </script>
    <!-- END: Modificaciones Menu -->
@endsection