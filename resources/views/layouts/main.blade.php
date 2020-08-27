
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="format-detection" content="telephone=no">
    {{--    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="language" content="{{ app()->getLocale() }}">

    <title>@yield('title', 'Snickers')</title>
    <link rel="stylesheet" href="{{ mix("/css/main.css") }}" type="text/css" >
    @yield('styles')

    {{--    FAVICON--}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset("/favicon/apple-touch-icon.png") }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("/favicon/favicon-32x32.png") }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("/favicon/favicon-16x16.png") }}">
    <link rel="manifest" href="{{ asset("/favicon/site.webmanifest") }}">

    {{--    OG--}}
    <meta property="og:title" content="На учёбу зарядись! Выигрывай крутые призы!">
    <meta property="og:url" content="{{ url("/") }}" />
    <meta property="og:image" content="{{ asset("/images/OG.jpg") }}" />
    <script src="{{ mix("/js/main.js") }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-169359655-7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-169359655-7');
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M4Q6KW2');</script>
    <!-- End Google Tag Manager -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4Q6KW2"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@yield('header')

@yield('content')

@yield('footer')

@yield('modals')

@yield('bottom-scripts')

</body>

</html>
