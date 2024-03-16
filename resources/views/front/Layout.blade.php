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
    <!-- Default Statcounter code for Tenis Indo http://tenisindo.com -->
    <script type="text/javascript">
        var sc_project = 12978658;
        var sc_invisible = 1;
        var sc_security = "69ffd98b";
    </script>
    <script type="text/javascript" src="https://www.statcounter.com/counter/counter.js" async></script>
    <noscript>
        <div class="statcounter"><a title="Web Analytics" href="https://statcounter.com/" target="_blank"><img
                    class="statcounter" src="https://c.statcounter.com/12978658/0/69ffd98b/1/" alt="Web Analytics"
                    referrerPolicy="no-referrer-when-downgrade"></a></div>
    </noscript>
    <!-- End of Statcounter Code -->
</body>

</html>
