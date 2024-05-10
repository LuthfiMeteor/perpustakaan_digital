<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital Library</title>

    <meta name="description" content="" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    {{-- {{ asset('asset-template') }} --}}
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('asset-template/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset-template/vendor/fonts/tabler-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/pages/front-page.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/swiper/swiper.css') }}" />

    <!-- Page CSS -->

    @stack('css')
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/pages/front-page-landing.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('asset-template/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('asset-template/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('asset-template/js/front-config.js') }}"></script>
</head>

<body>
    <script src="{{ asset('asset-template/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/js/mega-dropdown.js') }}"></script>

    <!-- Navbar: Start -->
    @include('landing-page.component.navbar')
    <!-- Navbar: End -->

    <!-- Sections:Start -->

    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        @yield('content')
        <!-- Hero: End -->
    </div>

    <!-- / Sections:End -->
    @include('landing-page.component.footer')

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('asset-template/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/node-waves/node-waves.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('asset-template/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('asset-template/js/front-main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('asset-template/js/front-page-landing.js') }}"></script>
</body>

</html>
