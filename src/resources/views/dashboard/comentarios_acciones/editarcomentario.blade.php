@extends('dashboard.partials.content')
<title>Editar Comentario | Hacktiva</title>
@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Editar Comentario</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">{{ __("DashboardComentarios3") }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/dashboard/comentarios">{{ __("DashboardComentarios1") }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Editar Comentario
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
                                        <form action="{{ route('dashboard_comentarios.editar') }}" method="POST">
                                            @csrf
                                                <div class="row">
                                                    <div class="col-12 col-sm-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Artículo</label>
                                                                @forelse($comment->articles as $article)
                                                                    <input name="articulo" id="articulo" value="{{ $article->title }}" type="text" class="form-control" autocomplete="off" required data-validation-required-message="Este campo es obligatorio" readonly>
                                                                @empty
                                                                    <input name="articulo" id="articulo" value="" type="text" class="form-control" autocomplete="off" required data-validation-required-message="Este campo es obligatorio" readonly>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Usuario</label>
                                                                @forelse($comment->users as $user)
                                                                    <input name="usuario" id="usuario" value="{{ $user->name }}" type="text" class="form-control" autocomplete="off" required data-validation-required-message="Este campo es obligatorio" readonly>
                                                                @empty
                                                                    <input name="usuario" id="usuario" value="" type="text" class="form-control" autocomplete="off" required data-validation-required-message="Este campo es obligatorio" readonly>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Estado</label>
                                                                <select name="estado" class="form-control" id="basicSelect" required>
                                                                    <option value="1" @if ($comment->status === "1") {{ __("selected") }} @endif>PUBLICADO</option>
                                                                    <option value="2" @if ($comment->status === "2") {{ __("selected") }} @endif>ELIMINADO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Fecha del Comentario</label>
                                                                <input name="fechaComentario" id="fechaComentario" value="{{ $comment->created_at->format('d-m-Y') }}" type="text" class="form-control" autocomplete="off" required data-validation-required-message="Este campo es obligatorio" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label class="label-dashboard">Comentario</label>
                                                                <textarea class="form-control" style="resize: none;" name="comentario" id="comentario" autocomplete="off" placeholder="Comentario del Usuario" readonly>{{ $comment->comment }}</textarea>
                                                                <input type="hidden" name="idComentario" id="idComentario" value="{{ $comment->id }}" readonly>
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
    <script src="{{ asset('/dash/app-assets/js/scripts/ui/comentarios/data-list-view.js') }}"></script>
    <script>
        $('#type-success').on('click', function () {
            Swal.fire({
                title: "Comentario Modificado!",
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
        let menuComentarios = document.getElementById('menuComentarios');
        menuInicio.classList.remove('active');
        menuComentarios.classList.add('active');
    </script>
    <!-- END: Modificaciones Menu -->
@endsection