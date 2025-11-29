<x-guest-layout>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />



    <form method="POST" action="{{ route('login') }}">
        @csrf
       <div class="flex flex-col justify-between md:flex-row-reverse">
            <!-- ----------- TEKS SELAMAT DATANG ----------- -->
            <div class="flex items-center justify-center md:w-1/2">
                <div class="text-1xl font-semibold md:ml-14 text-left md:text-3xl leading-tight top-10">
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
                <div class="mt-3">
                    <x-text-input id="password"
                        class="block mt-1 w-full placeholder:text-black text-sm py-1.5"
                        type="password"
                        name="password"
                        required autocomplete="current-password"
                        placeholder="Password"/>
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
                    <x-login-button class="md:w-auto md:h-1 bg-[#9DFF00] px-4 py-1 font-semibold text-lg tracking-tighter">
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
</x-guest-layout>
