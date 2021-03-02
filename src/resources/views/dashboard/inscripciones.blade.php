@extends('dashboard.partials.content')
<title>Gestionar Inscripciones | Hacktiva</title>
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Inscripciones</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">{{ __("DashboardWebinars3") }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Inscripciones
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Data list view starts -->
                <section id="data-list-view" class="data-list-view-header">
                    <div class="action-btns d-none">
                        <div class="btn-dropdown mr-1 mb-1">
                        </div>
                    </div>

                    <!-- DataTable starts -->
                    <div class="table-responsive">
                        <table class="table data-list-view">
                            <thead>
                            <tr>
                                <th style="text-align: center;">Curso</th>
                                <th style="text-align: center;">Módulo</th>
                                <th style="text-align: center;">Usuario</th>
                                <th style="text-align: center;">Fecha Creada</th>
                                <th style="text-align: center;">{{ __("DashboardWebinars7") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse(DB::table('module_user')->select('module_id','user_id','created_at','updated_at','deleted_at')->orderBy('created_at','DESC')->get() as $inscripcion)
                                <tr>
                                    <td style="text-align: center;">{{ DB::table('courses')->select('name','id')->where('id','=',DB::table('module_course')->select('course_id')->where('module_id','=',$inscripcion->module_id)->first()->course_id)->first()->name }}</td>
                                    <td style="text-align: center;">{{ DB::table('modules')->select('name')->where('id','=',$inscripcion->module_id)->first()->name }}</td>
                                    <td style="text-align: center;">{{ DB::table('users')->select('name')->where('id','=',$inscripcion->user_id)->first()->name }} {{ DB::table('users')->select('last_name')->where('id','=',$inscripcion->user_id)->first()->last_name }}</td>
                                    <td style="text-align: center;">{{ $inscripcion->created_at }}</td>
                                    <td style="text-align: center;">
                                        @if ($inscripcion->deleted_at === null)
                                            <span class="deleteBtn"><i class="feather icon-trash"></i></span>
                                            <span style="display: none;" id="idInscripcionSeleccionada">{{ DB::table('module_course')->select('course_id')->where('module_id','=',$inscripcion->module_id)->first()->course_id }}</span>
                                            <span style="display: none;" id="idUsuarioInscripcionSeleccionada">{{ $inscripcion->user_id }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- DataTable ends -->
                </section>
                <!-- Data list view end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: DELETE MODAL -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("DashboardWebinars8") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('dashboard_inscripciones.eliminar') }}" method="POST">
                    @csrf
                        <div class="modal-body">
                            <input type="hidden" name="deleteId" id="deleteId">
                            <input type="hidden" name="deleteIdUsuario" id="deleteIdUsuario">
                            <h4>{{ __("DashboardWebinars9") }}</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("DashboardWebinars13") }}</button>
                            <button type="submit" class="btn btn-primary" name="deleteData">{{ __("DashboardWebinars12") }}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: DELETE MODAL -->

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
    <script src="{{ asset('/dash/app-assets/js/scripts/ui/inscripciones/data-list-view.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Modificaciones Menu -->
    <script>
        let menuInicio = document.getElementById('menuInicio');
        let menuInscripciones = document.getElementById('menuInscripciones');
        menuInicio.classList.remove('active');
        menuInscripciones.classList.add('active');
    </script>
    <!-- END: Modificaciones Menu -->
@endsection