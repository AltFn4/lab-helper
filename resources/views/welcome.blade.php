<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LabLink - Your Virtual Lab Assistant</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-800">
        <div class="px-5 w-screen h-screen relative">
            <div class="absolute inset-x-0 top-0 z-10 w-screen">
                <div class="grid grid-cols-2 justify-between">
                    <h2 class="p-5 text-gray-300 text-xl">
                        LabLink
                    </h2>
                    <div class="p-5 text-right">
                        <a href="{{route('login')}}" class="p-5 text-gray-300 hover:animate-fade rounded">Login</a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="absolute inset-0 z-0 bg-gradient-to-r from-sky-500 to-indigo-500 w-screen"></div>
            <div class="flex flex-col gap-5 absolute inset-y-1/2 z-10 w-screen">
                <p class="text-center">
                    <a class="text-3xl">
                        Connect with your lab with
                    </a>
                    <br>
                    <a class="text-3xl text-gray-300">
                        LabLink
                    <a>
                    <br>
                    your trusted partner in productivity!
                </p>
            </div>
        </div>
    </body>
</html>
