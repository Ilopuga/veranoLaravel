<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Verano 2025</title>

        <!-- Cargar CSS con Vite -->
        @vite('resources/css/app.css')
    </head>
    <body>
        <!-- Este es el punto de montaje de Vue -->
        <div id="app"></div>

        <!-- Cargar JS con Vite -->
        @vite('resources/js/app.js')
    </body>
</html>
