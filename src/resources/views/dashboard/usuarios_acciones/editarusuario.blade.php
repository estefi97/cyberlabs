@extends('dashboard.partials.content')
<title>Editar Usuario | Hacktiva</title>
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Editar Usuario</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">{{ __("DashboardComentarios3") }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/dashboard/usuarios">{{ __("DashboardComentarios1") }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Editar Usuario
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
                                        <form action="{{ route('dashboard_usuarios.editar') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Nombre</label>
                                                            <input name="nombre" value="{{ $user->name }}" id="nombre" placeholder="Ingrese el Nombre del Usuario" type="text" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Apellido</label>
                                                            <input name="apellido" value="{{ $user->last_name }}" id="apellido" placeholder="Ingrese el Apellido del Usuario" type="text" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Cargar Imágen del Usuario</label>
                                                            @if($user->picture)
                                                                <br>
                                                                <img style="width: 150px; height: 150px;" src="{{ $user->pathAttachment() }}" />
                                                                <br>
                                                            @endif
                                                            <br>
                                                            <input type="file" name="nuevaImagenUsuario" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Perfil</label>
                                                            <select name="perfilUsuario" class="form-control" id="basicSelect" onchange="HabilitarCamposAdicionales()" required>
                                                                <option selected disabled>Seleccione un Perfil</option>
                                                                <option value="1" @if($user->role_id === 1) {{ __("selected") }} @endif>ADMINISTRADOR</option>
                                                                <option value="2" @if($user->role_id === 3) {{ __("selected") }} @endif>ESTUDIANTE</option>
                                                                <option value="3" @if($user->role_id === 2) {{ __("selected") }} @endif>PROFESOR</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Correo Electrónico</label>
                                                            <input name="email" value="{{ $user->email }}" id="email" placeholder="Ingrese el Correo Electrónico del Usuario" type="email" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    @if($user->student)
                                                        <div class="form-group" id="divStudent" style="display: none;">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Título del Estudiante</label>
                                                                <input name="studentTitle" value="{{ $user->student->title }}" id="studentTitle" placeholder="Ingrese el Título del Estudiante" type="text" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($user->teacher)
                                                        <div class="form-group" id="divTeacherTitle" style="display: none;">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Título del Profesor</label>
                                                                <input name="teacherTitle" value="{{ $user->teacher->title }}" id="teacherTitle" placeholder="Ingrese el Título del Profesor" type="text" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="divTeacherWebsite" style="display: none;">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Sitio Web del Profesor</label>
                                                                <input name="teacherWebsite" value="{{ $user->teacher->website_url }}" id="teacherWebsite" placeholder="Ingrese el Sitio Web del Profesor" type="text" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="divTeacherBiography" style="display: none;">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Biografía del Profesor</label>
                                                                <input name="teacherBiography" {{ $user->teacher->biography }} id="teacherBiography" placeholder="Ingrese la Biografía del Profesor" type="text" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Contraseña</label>
                                                            <input onchange="checkCamposCompletados()" name="contrasena" id="contrasena" placeholder="Ingrese la Contraseña del Usuario" type="password" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Reingresar Contraseña</label>
                                                            <input onchange="checkCamposCompletados()" name="repetirContrasena" id="repetirContrasena" placeholder="Ingrese nuevamente la Contraseña del Usuario" type="password" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <input type="hidden" value="{{ $user->id }}" name="idUsuario">
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
    <script src="{{ asset('/dash/app-assets/js/scripts/ui/webinars/data-list-view.js') }}"></script>
    <script>
        $('#type-success').on('click', function () {
            Swal.fire({
                title: "Usuario Modificado!",
                text: "Se han guardado los cambios con éxito!",
                type: "success",
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
            });
        });

        $(window).on("load", function() {
            let perfilSeleccionadoElement = document.getElementsByName("perfilUsuario")[0].options[document.getElementsByName("perfilUsuario")[0].selectedIndex].value;
            let divStudentElement = document.getElementById('divStudent');
            let divTeacherTitleElement = document.getElementById('divTeacherTitle');
            let divTeacherWebsiteElement = document.getElementById('divTeacherWebsite');
            let divTeacherBiographyElement = document.getElementById('divTeacherBiography');

            if (perfilSeleccionadoElement === "1") {
                divStudentElement.style.display = "inherit";
                divTeacherTitleElement.style.display = "inherit";
                divTeacherWebsiteElement.style.display = "inherit";
                divTeacherBiographyElement.style.display = "inherit";
            }
            if (perfilSeleccionadoElement === "3") {
                divStudentElement.style.display = "inherit";
                divTeacherTitleElement.style.display = "none";
                divTeacherWebsiteElement.style.display = "none";
                divTeacherBiographyElement.style.display = "none";
            }
            if (perfilSeleccionadoElement === "2") {
                divStudentElement.style.display = "none";
                divTeacherTitleElement.style.display = "inherit";
                divTeacherWebsiteElement.style.display = "inherit";
                divTeacherBiographyElement.style.display = "inherit";
            }
        });

        function HabilitarCamposAdicionales () {
            let perfilSeleccionadoElement = document.getElementsByName("perfilUsuario")[0].options[document.getElementsByName("perfilUsuario")[0].selectedIndex].value;
            let divStudentElement = document.getElementById('divStudent');
            let divTeacherTitleElement = document.getElementById('divTeacherTitle');
            let divTeacherWebsiteElement = document.getElementById('divTeacherWebsite');
            let divTeacherBiographyElement = document.getElementById('divTeacherBiography');

            if (perfilSeleccionadoElement === "1") {
                divStudentElement.style.display = "inherit";
                divTeacherTitleElement.style.display = "inherit";
                divTeacherWebsiteElement.style.display = "inherit";
                divTeacherBiographyElement.style.display = "inherit";
            }
            if (perfilSeleccionadoElement === "3") {
                divStudentElement.style.display = "inherit";
                divTeacherTitleElement.style.display = "none";
                divTeacherWebsiteElement.style.display = "none";
                divTeacherBiographyElement.style.display = "none";
            }
            if (perfilSeleccionadoElement === "2") {
                divStudentElement.style.display = "none";
                divTeacherTitleElement.style.display = "inherit";
                divTeacherWebsiteElement.style.display = "inherit";
                divTeacherBiographyElement.style.display = "inherit";
            }
        }
    </script>
    <!-- END: Page JS-->

    <!-- BEGIN: Modificaciones Menu -->
    <script>
        let menuInicio = document.getElementById('menuInicio');
        let menuUsuarios = document.getElementById('menuUsuarios');
        menuInicio.classList.remove('active');
        menuUsuarios.classList.add('active');
    </script>
    <!-- END: Modificaciones Menu -->

    <!-- BEGIN: Validar que la contraseña coincida -->
    <script>
        function checkCamposCompletados() {
            let inputContrasena = document.getElementById('contrasena');
            let inputRepetirContrasena = document.getElementById('repetirContrasena');
            let botonGuardarCambios = document.getElementById('type-success');

            if (inputContrasena.value != "" && inputRepetirContrasena.value != "") {

                if (inputContrasena.value == inputRepetirContrasena.value) {
                    botonGuardarCambios.disabled = false;
                } else {
                    botonGuardarCambios.disabled = true;
                }

            } else {
                botonGuardarCambios.disabled = true;
            }
        }
    </script>
    <!-- END: Validar que la contraseña coincida -->

@endsection