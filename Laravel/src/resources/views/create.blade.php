<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo作成</title>
    </head>
    <body>
        <div id="app">
            <create :csrf="{{json_encode(csrf_token())}}"></create>
        </div>
        <script src="{{ mix('js/app.js') }}"></script> 
    </body>
</html>
