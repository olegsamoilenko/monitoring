<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (Auth::check())
        <meta name="user" content="{{ Auth::user() }}">
    @endif


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="https://49bc-8-26-176-97.eu.ngrok.io/js/app.js" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="https://49bc-8-26-176-97.eu.ngrok.io/css/app.css" rel="stylesheet"> -->
</head>
<body>
<div id="app">
    @if (Auth::check())
        <the-header-admin :user="{{Auth::user()}}"></the-header-admin>
    @else
        <the-header-admin></the-header-admin>
    @endif

    @yield('content')

</div>
<div id="modal"></div>
</body>
</html>
