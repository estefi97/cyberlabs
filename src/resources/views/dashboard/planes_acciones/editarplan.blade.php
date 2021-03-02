@extends('dashboard.partials.content')
<title>Editar Plan | Hacktiva</title>
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
                            <h2 class="content-header-title float-left mb-0">Editar Plan</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">{{ __("DashboardComentarios3") }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/dashboard/planes">{{ __("DashboardComentarios1") }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Editar Plan
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
                                        <form action="{{ route('dashboard_planes.editar') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Título</label>
                                                            <input name="tituloPlan" id="tituloPlan" value="{{ $plan->name }}" placeholder="Ingrese el Título del Plan" type="text" class="form-control" autocomplete="off" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Precio</label>
                                                            <input name="precioPlan" id="precioPlan" value="{{ $plan->prize }}" placeholder="Ingrese el Precio del Plan" type="text" class="form-control" autocomplete="off" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Estado</label>
                                                            <select name="estadoPlan" class="form-control" id="basicSelect">
                                                                <option value="1" @if($plan->status === "1") {{ __("selected") }} @endif>ACTIVO</option>
                                                                <option value="2" @if($plan->status === "2") {{ __("selected") }} @endif>NO ACTIVO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">ID de Stripe</label>
                                                            <input name="idStripePlan" id="idStripePlan" value="{{ $plan->price_stripe_id }}" placeholder="Ingrese la ID de Stripe del Plan" type="text" class="form-control" autocomplete="off" >
                                                        </div>
                                                    </div>
                                                    <h2>Características del Plan</h2>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input
                                                                        type="checkbox"
                                                                        name="accesosATodosNuestrosCursos"
                                                                        @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','1']])->select('benefit')->first()->benefit === "SI")
                                                                            {{ __("checked") }}
                                                                        @endif
                                                                >
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">Accesos a todos nuestros cursos</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input
                                                                        type="checkbox"
                                                                        name="atendemosTodasTusInquietudes"
                                                                        @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','4']])->select('benefit')->first()->benefit === "SI")
                                                                            {{ __("checked") }}
                                                                        @endif
                                                                >
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">Atendemos todas tus inquietudes</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input
                                                                        type="checkbox"
                                                                        name="pagoDepositoPaypalYOtrosMetodos"
                                                                        @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','5']])->select('benefit')->first()->benefit === "SI")
                                                                            {{ __("checked") }}
                                                                        @endif
                                                                >
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">Pago depósito, Paypal y otros métodos</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input
                                                                        type="checkbox"
                                                                        name="certificadosDigitalesDeTusCursosAprobados"
                                                                        @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','6']])->select('benefit')->first()->benefit === "SI")
                                                                            {{ __("checked") }}
                                                                        @endif
                                                                >
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">Certificados Digitales de tus cursos aprobados</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input
                                                                        type="checkbox"
                                                                        name="derechoAReembolso"
                                                                        @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','11']])->select('benefit')->first()->benefit === "SI")
                                                                            {{ __("checked") }}
                                                                        @endif
                                                                >
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class="">Derecho a reembolso</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Oportunidades</label>
                                                            <input name="oportunidadesPlan" id="oportunidadesPlan" value="{{ DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','2']])->select('benefit')->first()->benefit }}" placeholder="Cantidad de oportunidades de rendir un curso" type="text" class="form-control" autocomplete="off" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Pago Recurrente</label>
                                                            <input name="pagoRecurrentePlan" id="pagoRecurrentePlan" value="{{ DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','3']])->select('benefit')->first()->benefit }}" placeholder="Por ejemplo: Anual, Semestral o Mensual" type="text" class="form-control" autocomplete="off" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Penetration Testing Student</label>
                                                            <select name="penetrationTestingStudent" class="form-control" id="basicSelect">
                                                                <option value="Opcional" @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','7']])->select('benefit')->first()->benefit === "Opcional") {{ __("selected") }} @endif>OPCIONAL</option>
                                                                <option value="No" @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','7']])->select('benefit')->first()->benefit === "No") {{ __("selected") }} @endif>NO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Penetration Testing Professional</label>
                                                            <select name="penetrationTestingProfessional" class="form-control" id="basicSelect">
                                                                <option value="Opcional" @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','8']])->select('benefit')->first()->benefit === "Opcional") {{ __("selected") }} @endif>OPCIONAL</option>
                                                                <option value="No" @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','8']])->select('benefit')->first()->benefit === "No") {{ __("selected") }} @endif>NO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Web Application Testing</label>
                                                            <select name="webApplicationTesting" class="form-control" id="basicSelect">
                                                                <option value="Opcional" @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','9']])->select('benefit')->first()->benefit === "Opcional") {{ __("selected") }} @endif>OPCIONAL</option>
                                                                <option value="No" @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','9']])->select('benefit')->first()->benefit === "No") {{ __("selected") }} @endif>NO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="label-dashboard">Information Security Analyst</label>
                                                            <select name="informationSecurityAnalyst" class="form-control" id="basicSelect">
                                                                <option value="Opcional" @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','10']])->select('benefit')->first()->benefit === "Opcional") {{ __("selected") }} @endif>OPCIONAL</option>
                                                                <option value="No" @if(DB::table('plan_feature')->where([['plan_id','=',$plan->id],['feature_id','=','10']])->select('benefit')->first()->benefit === "No") {{ __("selected") }} @endif>NO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <input type="hidden" name="idPlan" value="{{ $plan->id }}" readonly>
                                                <button name="insertData" type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" id="type-success">Guardar Cambios</button>
                                                <button type="reset" class="btn btn-outline-warning" id="botonCancelar">Cancelar</button>
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
    <script src="{{ asset('/dash/app-assets/js/scripts/ui/planes/data-list-view.js') }}"></script>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
    <script>
        $('#type-success').on('click', function () {
            Swal.fire({
                title: "Plan Modificado!",
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
        let menuPlanes = document.getElementById('menuPlanes');
        menuInicio.classList.remove('active');
        menuPlanes.classList.add('active');
    </script>
    <!-- END: Modificaciones Menu -->
@endsection