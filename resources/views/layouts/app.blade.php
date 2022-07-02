<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hill Climbing</title>
    <link href="{{ asset('assets/front/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('includes.front.style')
    @stack('after-style')
</head>
<body>

@include('includes.front.navbar')

<div class="container mb-5">
    @yield('content')
</div>

@include('includes.front.script')
@stack('script')
</body>
</html>
