<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>LabLink - Your Virtual Lab Assistant</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gradient-to-r from-sky-500 to-indigo-500">
    <div class="overflow-x-hidden relative">
        <div class="top-0 z-10 w-screen">
            <div class="grid grid-cols-2 justify-between">
                <h2 class="p-5 text-xl text-gray-300">
                    LabLink
                </h2>
                <div class="p-5 text-right">
                    <a href="{{route('login')}}" class="p-5 text-gray-300 rounded hover:animate-fade">Login</a>
                </div>
            </div>
            <hr>
        </div>
        <a id="top"></a>
        <article class="overflow-hidden snap-y snap-mandatory">
            <section class="box-border relative snap-center snap-always h-128">
                <div class="bg-center bg-no-repeat bg-cover blur bg-uni h-128"></div>
                <div class="flex absolute right-0 left-0 top-1/2 z-10 flex-col gap-5 justify-center mr-auto ml-auto w-full">
                    <p class="text-center">
                        <a class="text-3xl">
                            Connect with your lab with
                        </a>
                        <br>
                        <a class="text-3xl text-gray-300">
                            LabLink
                        </a>
                        <br>
                        your trusted partner in productivity!
                    </p>
                    <x-application-logo class="block w-auto h-20 text-gray-800 fill-current" />
                </div>

            </section>
            <section class="box-border relative snap-center snap-always h-128">
                <div class="bg-center bg-no-repeat bg-cover blur bg-happy_helper h-128"></div>
                <div class="flex absolute right-0 left-0 top-1/2 z-10 flex-col gap-5 justify-center mr-auto ml-auto w-full text-center">
                    <a class="text-3xl text-gray-300">
                        Fast Response Time
                    </a>
                    <p>
                        Sign off or Ask question with fast response time!
                    </p>
                    <x-clock-logo class="block w-auto h-20 text-gray-800 fill-current" />
                </div>


            </section>
            <section class="box-border relative snap-center snap-always h-128">
                <div class="bg-center bg-no-repeat bg-cover blur bg-happy_student h-128"></div>
                <p class="absolute right-0 left-0 top-1/2 z-10 justify-center mr-auto ml-auto w-full text-center">
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
