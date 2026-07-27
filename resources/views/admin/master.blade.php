<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>


    <meta charset="utf-8" />
    <title>Dashboard | Air Ticketing System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Air Ticketing System<" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ !empty($siteSettings?->favicon) ? asset('storage/' . $siteSettings->favicon) : asset('') . 'assets/images/logo-favicon.png' }}">



    <!-- App css -->
    <link href="{{ asset('') }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('') }}assets/css/app.min.css" rel="stylesheet" type="text/css" />

   @stack('styles')

</head>

<body>

    <!-- Top Bar Start -->
    <div class="topbar d-print-none">


        @include('admin.backend.parts.topbar')
    </div>
    <!-- Top Bar End -->

    @include('admin.sidebar')


    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            @yield('content')

            <!-- import footer section -->
            @include('admin.backend.parts.footer')
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->

    <script src="{{ asset('') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/libs/simplebar/simplebar.min.js"></script>

    <script src="{{ asset('') }}assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('') }}https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="{{ asset('') }}assets/js/pages/index.init.js"></script>
    <script src="{{ asset('') }}assets/js/DynamicSelect.js"></script>
    <script src="{{ asset('') }}assets/js/app.js"></script>
    @stack('scripts')
</body>
<!--end body-->

</html>
