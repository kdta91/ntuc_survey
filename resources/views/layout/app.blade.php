<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NTUC LearningHub</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.3.1-dist/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/Winwheel.js') }}"></script>
    <script src="{{ asset('greensock-js/src/uncompressed/TweenMax.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="container">
        <main class="row">
            @yield('content')
            @yield('scripts')
        </main>
    </div>
</body>

</html>