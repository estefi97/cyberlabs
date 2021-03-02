@extends('dashboard.partials.content')
<title>Editar Profesor | Hacktiva</title>
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Editar Profesor</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">{{ __("DashboardComentarios3") }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/dashboard/profesores">{{ __("DashboardComentarios1") }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Editar Profesor
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
                                        <!-- profesores edit account form start -->
                                        <form action="{{ route('dashboard_profesores.editar') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Usuario</label>
                                                            <select name="usuarioSeleccionado" class="form-control" id="basicSelect" disabled="disabled">
                                                                @foreach(DB::table('users')->where('role_id','=','2')->select('id','name','last_name')->get() as $user)
                                                                    <option value="{{ $user->id }}" @if($teacher->id === $user->id) {{ __("selected") }} @endif>{{ $user->name.' '.$user->last_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Título del Profesor</label>
                                                            <input name="teacherTitle" id="teacherTitle" value="{{ $teacher->title }}" placeholder="Ingrese el Título del Profesor" type="text" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Biografía del Profesor</label>
                                                            <input name="teacherBiography" id="teacherBiography" value="{{ $teacher->biography }}" placeholder="Ingrese el Título del Profesor" type="text" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Sitio Web del Profesor</label>
                                                            <input name="teacherWebsite" id="teacherWebsite" value="{{ $teacher->website_url }}" placeholder="Ingrese el Título del Profesor" type="url" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <input type="hidden" name="idProfesor" id="idProfesor" value="{{ $teacher->id }}" readonly>
                                                    <button name="insertData" type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" id="type-success">Guardar Cambios</button>
                                                    <button type="reset" class="btn btn-outline-warning" id="botonCancelar">Cancelar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- profesoress edit account form ends -->
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
    <script src="{{ asset('/dash/app-assets/js/scripts/ui/profesores/data-list-view.js') }}"></script>
    <script>
        $('#type-success').on('click', function () {
            Swal.fire({
                title: "Profesor Modificado!",
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
        let menuProfesores = document.getElementById('menuProfesores');
        menuInicio.classList.remove('active');
        menuProfesores.classList.add('active');
    </script>
    <!-- END: Modificaciones Menu -->
@endsection