@props(['user', 'header'])

{{-- Trophy / Score Card --}}
<div 
    style="background-color: {{ $header }};" 
    class="rounded-3xl border-4 border-black px-8 py-4
           shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]
           flex items-center gap-4"
>

    <!-- ICON TROPHY -->
    <div class="w-12 h-12 bg-white rounded-full 
                border-4 border-black 
                flex items-center justify-center
                shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
        <img 
            src="{{ asset('images/trophy.webp') }}" 
            alt="Trophy"
            class="w-7 h-7 object-contain"
        >
    </div>

    <!-- TOTAL SCORE -->
    <span class="text-3xl font-black text-white">
        {{ $user->xp }}
    </span>

</div>


