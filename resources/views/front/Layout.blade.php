<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/logo/logo-tenis-demo.png">
</head>
<body>
@include('front.components.Header')

@yield('body')

@include('front.components.Footer')

<script src="/js/app.js"></script>
</body>
</html>
