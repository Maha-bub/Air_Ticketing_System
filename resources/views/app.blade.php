<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        
        <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/animate/custom-animate.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/jetly-icons/style.css">
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/tiny-slider/tiny-slider.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/reey-font/stylesheet.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/owl-carousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/vegas/vegas.min.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/timepicker/timePicker.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/vendors/nice-select/nice-select.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/css/jetly.css" />
    <link rel="stylesheet" href="{{asset("")}}frontend-assets/css/jetly-responsive.css" />


        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

    <script src="{{asset("")}}frontend-assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/jarallax/jarallax.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/nouislider/nouislider.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/odometer/odometer.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/swiper/swiper.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/tiny-slider/tiny-slider.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/wnumb/wNumb.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/wow/wow.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/isotope/isotope.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/countdown/countdown.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/vegas/vegas.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/jquery-ui/jquery-ui.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/timepicker/timePicker.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/circleType/jquery.circleType.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/circleType/jquery.lettering.min.js"></script>
    <script src="{{asset("")}}frontend-assets/vendors/nice-select/jquery.nice-select.min.js"></script>




    <!-- template js -->
    <script src="{{asset("")}}frontend-assets/js/jetly.js"></script>
    </body>
</html>
