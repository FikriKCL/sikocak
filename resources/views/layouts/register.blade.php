<!DOCTYPE html>
      {{-- <-- INI COMMENT --> --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIKOCAK') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-[#9DFF00] bg-cover bg-center bg-no-repeat flex items-center justify-center font-sans antialiased overflow-hidden">
     <img src="images/shape1.svg" class="hidden md:block  md:w-[37rem] absolute -z-10 md:right-[60rem] md:top-[22rem]"/>
     <img src="images/shape2.svg" class="hidden md:block  md:w-[37rem] absolute -z-10 md:right-[20rem] md:top-[26rem]"/>
     <img src="images/shape3.svg" class="hidden md:block  md:w-[21rem] absolute -z-10 md:right-[57rem] md:bottom-[20rem]"/>
     <img src="images/shape4.svg" class="hidden md:block  md:h-[50rem] md:w-[40rem] md:left-[60rem] md:bottom-[20rem] absolute -z-10"/>     <img src="images/shape1.svg" class="hidden md:block  md:w-[37rem] absolute -z-10 md:right-[60rem] md:top-[22rem]"/>
     <img src="images/shape2.svg" class="hidden md:block  md:w-[37rem] absolute -z-10 md:right-[20rem] md:top-[26rem]"/>
     <img src="images/shape3.svg" class="hidden md:block  md:w-[21rem] absolute -z-10 md:right-[57rem] md:bottom-[20rem]"/>
     <img src="images/shape4.svg" class="hidden md:block  md:h-[50rem] md:w-[40rem] md:left-[60rem] md:bottom-[20rem] absolute -z-10"/>

    <div>
        <!-- Wrapper -->
        <div class="w-60 flex shrink-0 items-center md:w-[30rem] md:h-auto bg-white rounded-3xl shadow-xl p-10 border-2 border-black ">
            {{ $slot }}
        </div>
    </div>

    </body>
</html>

    </body>
</html>
