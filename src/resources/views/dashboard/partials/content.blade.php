<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Autores | Biblioteca</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/pages/app-user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/plugins/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/pages/data-list-view.css') }}">

    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <style>
        table.data-list-view.dataTable thead .sorting:before {
            display: none !important;
        }
        table.data-list-view.dataTable thead .sorting:after {
            display: none !important;
        }
        table.data-list-view.dataTable thead .sorting_desc:before {
            display: none !important;
        }
        table.data-list-view.dataTable thead .sorting_desc:after {
            display: none !important;
        }
        table.data-list-view.dataTable thead .sorting_asc:before {
            display: none !important;
        }
        table.data-list-view.dataTable thead .sorting_asc:after {
            display: none !important;
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

@include('dashboard.partials.menu')

@include('dashboard.partials.main-menu')

<!-- BEGIN: Content-->
@yield('content')

</body>
<!-- END: Body-->

</html>