<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @routes
        @inertiaHead
    </head>
    <body class="text-gray-800 dark:text-gray-300">
    <div id="inertiaDiv">
        @inertia
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
