<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Home</title>
    </head>
    <body>
        <div id="app">
            <todo-view :csrf="{{json_encode(csrf_token())}}" :todos="{{json_encode($todos)}}"></todo-view>
        </div>
        <script src="{{ mix('js/app.js') }}"></script> 
    </body>
</html>
