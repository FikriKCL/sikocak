<x-register-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-6">
            <!-- <x-input-label for="name" :value="__('Name')" /> -->
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" placeholder="Nama" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')"  class="w-auto"/>
        </div>

        <div class="mt-6">
            <!-- <x-input-label for="name" :value="__('Username')" /> -->
           <x-text-input id="username" class="block w-full" type="text" name="username" :value="old('username')" placeholder="Username"  required autofocus autocomplete="username" pattern="^[a-z0-9]+$" onkeydown="return event.key !== ' '" oninput="this.value = this.value.toLowerCase().replace(/\s+/g, '')" title="Usernmame harus lowercase dan tanpa spasi."/>
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <!-- <x-input-label for="email" :value="__('Email')" /> -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
      {{-- <-- INI COMMENT --> --}}
        <!-- Password -->
        <div class="mt-3 rounded-full" x-data="{ show: false }">
                <div class="relative">
                    <input 
                        :type="show ? 'text' : 'password'"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Password"
                        class="block mt-1 w-full rounded-full placeholder:text-black text-sm py-1.5"
                    />

                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-3 flex items-center"
                    >
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.944-9.542-7a10.05 10.05 0 012.28-3.956m3.124-2.484A9.956 9.956 0 0112 5c4.478 0 8.268 2.944 9.543 7a9.958 9.958 0 01-4.304 5.235M15 12a3 3 0 00-3-3m0 0a2.99 2.99 0 00-1.219.257M9.88 9.88L4.22 4.22m15.56 15.56L14.12 14.12" />
                        </svg>
                    </button>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>

        <!-- Confirm Password -->
        <div class="mt-3 rounded-full" x-data="{ show: false }">
                <div class="relative">
                    <input 
                        :type="show ? 'text' : 'password'"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        autocomplete="current-password"
                        placeholder="Ulangi Password"
                        class="block mt-1 w-full rounded-full border-black placeholder:text-black text-sm py-1.5"
                    />

                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-3 flex items-center"
                    >
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.944-9.542-7a10.05 10.05 0 012.28-3.956m3.124-2.484A9.956 9.956 0 0112 5c4.478 0 8.268 2.944 9.543 7a9.958 9.958 0 01-4.304 5.235M15 12a3 3 0 00-3-3m0 0a2.99 2.99 0 00-1.219.257M9.88 9.88L4.22 4.22m15.56 15.56L14.12 14.12" />
                        </svg>
                    </button>
                </div>

            </div>
        <div class="flex items-center justify-center flex-col mt-4">

        <x-register-button class="h-6 text-base">
                {{ __('Daftar') }}
            </x-register-button>

            <div class="my-2">
                Sudah memiliki akun? <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Klik disini') }}
            </a>
            </div>

            
        </div>
    </form>

        <div class="flex items-center justify-center md:w-1/2 pb-5">
                <div class="hidden text-2xl font-semibold md:block  md:ml-12 text-left md:text-3xl leading-tight top-10 ">
                    Selamat Datang Jagoan!
                </div>
            </div>
</x-register-layout>
