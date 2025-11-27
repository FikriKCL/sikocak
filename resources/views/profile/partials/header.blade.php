       <div class="max-w-screen-md mx-auto sm:px-6 lg:px-8 pt-4">
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

                <div class="place-self-center w-32 md:w-72 h-16 shadow-bottomSm border-2 border-black bg-white overflow-hidden rounded-full">
                    <div class="p-4 md:p-3 text-basetext-gray-900 text-center font-bold md:text-2xl font-jostt">
                        {{ ("Profil Akun") }}
                    </div>
                </div>

            </div>
        </div>