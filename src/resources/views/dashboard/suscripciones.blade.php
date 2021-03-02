@extends('dashboard.partials.content')
<title>{{ __("DashboardSuscripciones1") }} | Hacktiva</title>
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ __("DashboardSuscripciones2") }}</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">{{ __("DashboardSuscripciones3") }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ __("DashboardSuscripciones2") }}
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
                                <th style="text-align: center;">{{ __("DashboardSuscripciones4") }}</th>
                                <th style="text-align: center;">{{ __("DashboardSuscripciones14") }}</th>
                                <th style="text-align: center;">{{ __("DashboardSuscripciones5") }}</th>
                                <th style="text-align: center;">{{ __("DashboardSuscripciones7") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subscription->all()->sortByDesc('id') as $subscription)
                                <tr>
                                    <td style="text-align: center;">{{ $subscription->user()->withTrashed()->where('id', $subscription->user_id)->pluck('name')->first() }}</td>
                                    <td style="text-align: center;">
                                        @if ($subscription->created_at)
                                            {{ $subscription->created_at->format('d-m-Y') }}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        @if ($subscription->ends_at)
                                            {{ Carbon\Carbon::parse($subscription->ends_at)->format('d-m-Y') }}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('dashboard_suscripciones_editar', $subscription->id) }}"><span class="editBtn"><i class="feather icon-edit"></i></span></a>
                                        @if ($subscription->ends_at === null)
                                            <span class="deleteBtn"><i class="feather icon-trash"></i></span>
                                            <span style="display: none;" id="idSuscripcionSeleccionado">{{ $subscription->id }}</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("DashboardSuscripciones8") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('dashboard_suscripciones.eliminar') }}" method="POST">
                    @csrf
                        <div class="modal-body">
                            <input type="hidden" name="deleteId" id="deleteId">
                            <h4>{{ __("DashboardSuscripciones9") }}</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("DashboardSuscripciones13") }}</button>
                            <button type="submit" class="btn btn-primary" name="deleteData">{{ __("DashboardSuscripciones12") }}</button>
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
    <script src="{{ asset('/dash/app-assets/js/scripts/ui/suscripciones/data-list-view.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Modificaciones Menu -->
    <script>
        let menuInicio = document.getElementById('menuInicio');
        let menuSuscripciones = document.getElementById('menuSuscripciones');
        menuInicio.classList.remove('active');
        menuSuscripciones.classList.add('active');
    </script>
    <!-- END: Modificaciones Menu -->
@endsection