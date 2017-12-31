<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
        
        @include('layout._header')
        
        <div class="container">
            @include('layout._message')
            @yield('content')
        </div>

        @include('layout._footer')
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>