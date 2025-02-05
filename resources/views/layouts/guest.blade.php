<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center pt-6 min-h-screen bg-gradient-to-r from-sky-500 to-indigo-500 sm:justify-center sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 text-gray-800 fill-current" />
                </a>
            </div>

            <div class="overflow-hidden px-6 py-4 mt-6 w-full bg-white shadow-md sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
