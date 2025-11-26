@props(['user'])
<div class="place-self-center mt-10 md:w-[28rem] md:h-[30rem] mx-auto bg-white rounded-[64px] border-4 border-black shadow-bottom p-6">

    {{-- Profile Icon --}}
    <div class="w-40 h-40 mx-auto mb-4 flex items-center justify-center
                border-4 border-black rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
             viewBox="0 0 16 16" class="w-16 h-16 text-[#35401B]">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
            <path d="M14 14s-1-4-6-4-6 4-6 4 1 2 6 2 6-2 6-2Z"/>
        </svg>
    </div>

    {{-- Name --}}
   <div
        title="{{ $user->name }}"
        class="w-32 h-10 place-self-center md:w-96 md:h-20 bg-white rounded-full
            border-2 border-black shadow-[0px_6px_0_#777]
            text-sm md:text-3xl text-center py-2 md:py-5 mb-3 font-bold
            truncate overflow-hidden">
        {{ $user->name }}
    </div>


   <div
        title="{{ $user->email }}"
        class="w-32 h-10 place-self-center md:w-64 md:h-16 bg-white rounded-full
            border-2 border-black shadow-[0px_6px_0_#777]
            text-xs md:text-xl text-center py-2 md:py-4 mb-3 font-semibold
            truncate overflow-hidden">
        {{ $user->email }}
    </div>


    @if(auth()->check() && auth()->id() === $user->id)
        <div class="flex justify-center mt-12">
            <button onclick="window.location.href='{{ route('profile.edit', $user->username) }}'"
                class="w-32 md:py-1 md:w-40 md:h-12 bg-[#9DFF00] border-2 border-black rounded-full 
                    shadow-bottomSm py-2 text-lg font-semibold select-none">
                Edit?
            </button>
        </div>
    @endif
