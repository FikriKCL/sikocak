
<x-register-layout>
    <div class="flex flex-col items-center">
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <!-- Email Address -->
        <div class="mb-4 text-black">
            <x-input-label for="email" :value="__('Email')" class="text-black"/>
            <x-text-input 
                id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                required 
                autofocus 
                placeholder="Masukkan email"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Button dan Text Instruksi -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-4">
            <!-- Button -->
            <x-primary-button class="px-6 py-2 text-base w-full h-10 md:w-auto">
                {{ __('Kirim') }}
            </x-primary-button>

            <!-- Text -->
            <div class="hidden md:flex text-sm text-black md:text-left">
                {{ __('Lupa Password? Silahkan masukkan email untuk mengganti password!') }}
            </div>
        </div>
    </form>
</div>
</x-register-layout>

   
