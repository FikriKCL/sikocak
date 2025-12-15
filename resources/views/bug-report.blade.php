<!DOCTYPE html>
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

    <body class="min-h-screen bg-[#9DFF00] bg-cover bg-center bg-no-repeat flex items-center justify-center flex-col font-sans antialiased">
        <div class="max-w-screen-md mx-auto mb-12">
            <div class="flex items-center justify-center gap-6">
    
                <div class="w-12 h-12 bg-[#9DFF00] rounded-full border-2 border-black shadow-bottomSm">
                    <button onclick="window.location.href='{{ route('dashboard') }}'" class="place-self-center px-2 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                </div>

                <div class="place-self-center w-72 h-16 shadow-bottomSm border-2 border-black bg-white overflow-hidden rounded-full">
                    <div class="p-4 md:p-3 text-basetext-gray-900 text-center font-bold text-2xl font-jostt">
                        {{ ("Lapor Bug") }}
                    </div>
                </div>

            </div>
        </div>

        <div>
            <!-- Wrapper -->
            <div class="flex shrink-0 items-center md:h-auto sm:max-w-2xl bg-white rounded-3xl shadow-xl p-10 border-2 border-black ">
               <form method="POST" action="{{ route('bug-report.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Subjek -->
                <div class="mt-6">
                    <!-- <x-input-label for="name" :value="__('Name')" /> -->
                    <x-text-input id="subject" class="block w-full" type="text" name="subject" :value="old('subject')" placeholder="Subjek Bug" required autofocus autocomplete="subject" />
                    <x-input-error :messages="$errors->get('subject')"  class="w-auto"/>
                </div>

                <div class="mt-6">
                    <!-- <x-input-label for="name" :value="__('Username')" /> -->
                    <x-text-input id="description" class="block w-full h-24 rounded-xl" type="text" name="description" :value="old('description')" placeholder="Jelaskan bug nya seperti apa" required autofocus autocomplete="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>


                <!-- Email Address -->
                <div class="mt-4">
                    <!-- <x-input-label for="email" :value="__('Email')" /> -->
                    <x-text-input id="proof" class="block w-full" type="file" name="proof" :value="old('proof')" placeholder="Kirim tangkapan layar bug nya" required autocomplete="file" />
                    <x-input-error :messages="$errors->get('proof')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center flex-col mt-4">
                    <x-register-button class="h-6 text-base ">
                        {{ __('KIRIM ADUAN') }}
                    </x-register-button>
                </div>
                @if(session('success'))
                <script>
                    alert('Bug report berhasil dikirim!');

                    window.location.href = "{{ route('dashboard') }}";
                </script>
                @endif
                </form>
            </div>
        </div>
    </body>
</html>
