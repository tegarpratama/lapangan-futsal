<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link href="{{ asset('assets/front/img/logo.jpeg') }}" rel="icon"> --}}
    <title>Admin</title>
    @include('includes.back.style')
    @stack('after-style')
</head>

<body>

    @include('includes.back.sidebar')

    @include('includes.back.header')

    @yield('content')

    @include('includes.back.script')
    @stack('after-script');
</body>

</html>
