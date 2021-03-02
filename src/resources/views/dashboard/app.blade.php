<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>

    <!-- BEGIN: Importamos Fuente de Google -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet"/>
    <!-- END: Importamos Fuente de Google -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/vendors.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/charts/apexcharts.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/extensions/tether-theme-arrows.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/extensions/tether.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/vendors/css/extensions/shepherd-theme-default.css') }}"/>
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/bootstrap-extended.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/colors.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/components.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/themes/dark-layout.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/themes/semi-dark-layout.css') }}"/>
    <!-- END: Theme CSS -->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/core/menu/menu-types/vertical-menu.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/core/colors/palette-gradient.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/pages/dashboard-analytics.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/pages/card-analytics.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/app-assets/css/plugins/tour/tour.css') }}"/>
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dash/assets/css/style.css') }}" />
    <!-- END: Custom CSS-->

</head>
<body class="vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

    @include('dashboard.partials.menu')

    @include('dashboard.partials.main-menu')

    @yield('content')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/dash/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/dash/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/vendors/js/extensions/tether.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/dash/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('/dash/app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/dash/app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Importamos Feather Icons -->
    <script src="https://unpkg.com/feather-icons@4.10.0/dist/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        feather.replace();
    </script>
    <!-- END: Importamos Feather Icons -->
</body>
</html>