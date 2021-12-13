<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>

    <title>{{ env('APP_NAME', 'all about testing') }}</title>

    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet" />

    @stack('styles')
</head>
<body class="bg-base-200">
    <div class="bg-base-200 space-y-4">
        <div class="px-3">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scroll.js') }}" type="text/javascript"></script>

    @stack('scripts')
</body>
</html>