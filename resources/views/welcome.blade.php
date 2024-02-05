<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lab Helper</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-800">
        <div class="p-5 bg-gray-500 text-right">
            <a href="{{route('login')}}" class="text-gray">Login</a>
        </div>
        <div class="m-5 p-5">
            <h1 class="text-7xl text-center text-white">Lab Helper</h1>
            <p class="text-center text-gray-300">
                Welcome to the lab helper!
            </p>
        </div>
    </body>
</html>
