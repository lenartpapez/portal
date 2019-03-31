<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css" >

</head>
<body>
    <main>
        @yield('content')
    </main>
    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script>
        var apiUrl = "{{env("APP_URL")}}/api";
    </script>
    <script src="{{ asset('js/admin/app.js') }}?v={{time()}}" defer></script>
</body>
</html>
