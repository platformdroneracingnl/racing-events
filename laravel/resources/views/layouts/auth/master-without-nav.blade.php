<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.includes.title-meta')
    @include('layouts.includes.head')
</head>

@section('body')

    <body class="authentication-bg">
        <span class="mask bg-gradient-default opacity-7"></span>
    @show
    @yield('content')
    @include('layouts.includes.vendor-scripts')
</body>

</html>