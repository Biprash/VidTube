<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/512.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/192.png') }}">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}"/>
    {{-- <link rel="manifest" href="/site.webmanifest"> --}}
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
        @if (session('message'))
            <div class=" container alert alert-success mt-4 mb-0">
                {{ session('message') }}
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
