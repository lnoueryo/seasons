<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}"defer></script>
    <title>seasons</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/seasons.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        [v-cloak] {
            opacity: 0;
        }
    </style>
    </head>
    <body>
        <div id="app" v-cloak>
            <v-app>
                <index></index>
            </v-app>
        </div>
    </body>
</html>