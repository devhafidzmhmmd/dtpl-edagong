<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi ini merupakan tugas kuliah DTPL yang dirancang untuk mendukung pengalaman belanja online, pemesanan produk, serta pengelolaan toko dengan fitur lengkap dan antarmuka yang ramah pengguna.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @include('layouts._favicons')
    @stack('styles')
</head>
<body>
    <div id="app">
        @include('partial.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @stack('alpine')
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <style>
        @keyframes glitter-promo {
            0% {
                box-shadow: 0 0 10px #ffe066cc;
                filter: brightness(1.1);
            }
            50% {
                box-shadow: 0 0 18px #ffd800cc;
                filter: brightness(1.2);
            }
            100% {
                box-shadow: 0 0 14px #ffe177;
                filter: brightness(1.1);
            }
        }
        .glitter-text {
            background: linear-gradient(90deg, #fff7b1 10%, #fff 24%, #fd6800 70%, #ffd482 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-stroke: 1.2px #ffbb008c;
            text-shadow:
                0 0 9px #ffd700,
                0 0 4px #ff3838,
                0 2px 6px #fff, 
                0 0 16px #ff9800b2;
            animation: glitter-textflicker 1.7s infinite linear;
            letter-spacing: 0.8px;
            font-weight: bold;
        }
    
        @keyframes glitter-textflicker {
            0%, 100%   { filter: brightness(1); text-shadow: 0 0 10px #fff1; }
            18%        { filter: brightness(1.3); text-shadow: 0 0 18px #ffd800a7; }
            40%        { filter: brightness(1.13); }
            60%        { filter: brightness(1.22); text-shadow: 0 0 26px #ffc40089; }
            85%        { filter: brightness(0.97); }
        }
        </style>
    @stack('scripts')
</body>
</html>
