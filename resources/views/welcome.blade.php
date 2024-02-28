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

<body class="antialiased bg-gradient-to-r from-sky-500 to-indigo-500">
    <div class="relative overflow-x-hidden">
        <div class="top-0 z-10 w-screen">
            <div class="grid grid-cols-2 justify-between">
                <h2 class="p-5 text-gray-300 text-xl">
                    LabLink
                </h2>
                <div class="p-5 text-right">
                    <a href="{{ route('login') }}" class="p-5 text-gray-300 hover:animate-fade rounded">Login</a>
                </div>
            </div>
            <hr>
        </div>
        <a id="top"></a>
        <article class="snap-y snap-mandatory overflow-hidden">
            <section class="snap-center snap-always h-128 box-border relative">
                <div class="bg-uni bg-no-repeat bg-cover bg-center blur size-full"></div>
                <div
                    class="absolute w-full z-10 flex flex-col gap-5 justify-center top-1/2 left-0 right-0 ml-auto mr-auto">
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

            </section>
            <section class="snap-center snap-always h-128 box-border relative">
                <div class="bg-happy_helper bg-no-repeat bg-cover bg-center blur size-full"></div>
                <p class="absolute w-full z-10 gap-5 justify-center top-1/2 left-0 right-0 ml-auto mr-auto text-center">
                    <a class="text-3xl text-gray-300">
                        Fast Response Time
                    </a>
                    <br>
                    Sign off or Ask question with fast response time!
                </p>
            </section>
            <section class="snap-center snap-always h-128 box-border relative">
                <div class="bg-happy_student bg-no-repeat bg-cover bg-center blur size-full"></div>
                <p class="absolute w-full z-10 justify-center top-1/2 left-0 right-0 ml-auto mr-auto text-center">
                    <a class="text-3xl text-gray-300">
                        Enhanced lab experience
                    </a>
                    <br>
                    Provides you the better lab experience!
                </p>
            </section>
        </article>
        <a href="#top">Back to top</a>
    </div>
</body>

</html>
