<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body
        hoe-navigation-type="vertical"
        hoe-nav-placement="left"
        theme-layout="wide-layout"
        theme-bg="bg1"
    >
        <div id="app"></div>

        <script src="{{ url('https://kit.fontawesome.com/b415fa19aa.js')}}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/menu/3.4.1.jquery.min.js') }}"></script>
        <script src="{{ asset('js/menu/popper.min.js') }}"></script>
        <script src="{{ asset('js/menu/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" id="app-script" ></script>
    </body>

</html>
