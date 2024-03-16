<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/logo/logo-tenis-demo.png">
    <meta name="description"
        content="Situs web tentang tenis, turnamen, pemain, dan klasemen tenis di Indonesia dan dunia.">
    <meta name="keywords"
        content="tenis, tenis Indonesia, tenis profesional, tenis klasemen, pemain tenis, turnamen tenis Indonesia, klasemen pemain tenis, tenis amatir">
    <title>TenisIndo</title>
</head>

<body>
    @include('front.components.Header')

    @yield('body')

    @include('front.components.Footer')

    {{-- <script src="/js/app.js"></script> --}}
</body>

</html>
