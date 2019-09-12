<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- SCRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel React TaskMan</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="flex-center position-ref full-height">
           
        </div>
        <footer>
            <script src="{{ asset('js/app.js') }}"></script>
        </footer>
    </body>
</html>
