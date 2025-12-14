@props(['rankUser', 'position', 'isMe' => false])
      {{-- <-- INI COMMENT --> --}}
<div
    data-me="{{ $isMe ? 'true' : 'false' }}"
    class="
        mt-10 place-self-center w-3/4 h-32
        flex items-center
        border-2 rounded-full shadow-bottomSm
        transition-all duration-300
        hover:scale-105 hover:-translate-y-1
        {{ $isMe
            ? 'ring-4 ring-[#9DFF00]/70 scale-[1.05]'
            : ''
        }}
    "
    style="background: {{ $rankUser->rank->gradient() }}"
>
    <div class="flex items-center h-full px-6 gap-6 w-full">

        {{-- NUMBER --}}
        <div
            class="
                flex items-center justify-center 
                w-12 h-12 sm:w-16 sm:h-16 md:w-24 md:h-24
                shadow-bottomSm border-2 border-black 
                bg-white rounded-full
                {{ $isMe ? 'animate-pulse' : '' }}
            "
        >
            <p class="text-base sm:text-xl md:text-5xl font-jost font-semibold">
                {{ $position }}
            </p>
        </div>

        {{-- NAME --}}
        <div class="flex items-center gap-3 sm:text-2xl md:ml-6 md:text-4xl font-medium font-jost text-white">
            {{ $rankUser->name }}

            @if ($isMe)
                <span class="text-xs font-bold px-2 py-1 rounded-full bg-black text-[#9DFF00]">
                    KAMU
                </span>
            @endif
        </div>

        {{-- RIGHT BOX --}}
        <div
            class="
                flex items-center ml-auto
                sm:w-32 sm:h-16 md:w-64 md:h-24
                shadow-lg border-2 border-black rounded-full px-6
            "
            style="background: {{ $rankUser->rank->gradient() }}"
        >
            {{-- BADGE IMAGE --}}
            <img
                src="{{ $rankUser->rank->badge() }}"
                class="hidden sm:block md:w-16 md:h-22 mr-4"
            >

            {{-- POINT --}}
            <div class="ml-auto text-white sm:text-2xl md:text-5xl font-semibold">
                {{ $rankUser->xp }}
            </div>
        </div>

    </div>
</div>
