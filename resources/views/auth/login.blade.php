<x-guest-layout>
    
    <!-- Session Status -->

    <form method="POST" action="{{ route('login') }}">
        @csrf
       <div class="flex flex-col justify-between md:flex-row-reverse items-center m-auto">
            <!-- ----------- TEKS SELAMAT DATANG ----------- -->
            <div class="flex items-center justify-center md:w-1/2 pb-5">
                <div class=" text-2xl font-semibold md:ml-12 text-left md:text-3xl leading-tight top-10 ">
                    Selamat Datang
                    <p>Jagoan!</p>
                </div>
            </div>

            <!-- ----------- FORM LOGIN ----------- -->
            <div class="md:w-1/2">

                <!-- Email -->
                <div>
                    <x-text-input id="email" 
                        class="block mt-1 w-full placeholder:text-black text-sm py-1.5"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus autocomplete="username"
                        placeholder="Email"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

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

                <!-- Remember + Lupa Password -->
                <div class="mt-3 flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center text-xs">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-3 w-3"
                            name="remember">
                        <span class="ms-2 text-xs text-gray-600">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="underline text-xs text-gray-600 hover:text-gray-900">
                        Lupa password?
                    </a>
                    @endif
                </div>

                <!-- Tombol Masuk -->
                <div class="flex items-center justify-center mt-3">
                    <x-login-button class="w-auto h-1  bg-[#9DFF00] px-4 py-1 font-semibold text-lg tracking-tighter">
                        {{ __('Masuk') }}
                    </x-login-button>
                </div>

                <!-- ----------- TOMBOL SOSIAL MINI ----------- -->
                <!-- <div class="flex flex-col items-center justify-center mt-5 space-y-2
                    sm:flex-row sm:space-y-0 sm:space-x-2">

                  
                    <div class="flex space-x-2">

                   
                        <div class="w-24 h-9 shrink-0 flex items-center justify-center
                                    bg-black border-black border-2 rounded-full
                                    text-xs font-semibold uppercase tracking-wider
                                    text-white transition duration-150 hover:bg-green-100 cursor-pointer">
                            <img class="h-4" src="svg/apple-logo.svg" alt="apple">
                        </div>

                  
                        <div class="w-24 h-9 shrink-0 flex items-center justify-center
                                    bg-white border-black border-2 rounded-full
                                    text-xs font-semibold uppercase tracking-wider
                                    text-black transition duration-150 hover:bg-green-100 cursor-pointer">
                            <img class="h-4" src="svg/google-logo.svg" alt="google">
                        </div>
                    </div>

                    
                    <div class="w-24 h-9 shrink-0 flex items-center justify-center
                                bg-gray-400 border-black border-2 rounded-full
                                text-xs font-semibold uppercase tracking-wider
                                text-black whitespace-nowrap
                                transition duration-150 hover:bg-green-100 cursor-pointer">
                        {{ __('LAINNYA') }}
                    </div>

                </div> -->

                <!-- Belum Punya Akun -->
                <div class="flex items-center justify-center mt-5 text-xs">
                    Belum punya akun?
                </div>
                
                
                <!-- Tombol Klik Disini -->
                <div class="flex items-center justify-center mt-3">
                    <a href="{{ route('register') }}">
                         <div class="underline cursor-pointer italic inline-flex items-center px-3 py-0.5
                                bg-white border-black border-2 rounded-full
                                font-semibold text-[10px] text-black uppercase tracking-wider
                                hover:bg-green-100 transition duration-150">
                        {{ __('Klik Disini') }}
                    </div>
                    </a>
                   
                </div>
               

            </div>
        </div>

        
        
                    
    </form>
    </div>
        @if (session('status'))
            <div class="mt-4 p-3 rounded-lg bg-green-600 text-white text-center animate-pulse">
                {{ session('status') }}
            </div>
        @endif
</x-guest-layout>
