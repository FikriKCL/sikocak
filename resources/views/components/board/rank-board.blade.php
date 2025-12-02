@props(['rankUser', 'position'])

<div class="hover:scale-105 transition delay-100 duration-200 ease-in-out hover:-translate-y-1 mt-10 place-self-center w-3/4 h-32 shadow-bottomSm border-2 border-black overflow-hidden rounded-full"
     style="background: {{ $rankUser->rank->gradient() }}">

    <div class="flex items-center h-full px-6 gap-6">

        {{-- NUMBER --}}
        <div class="flex items-center justify-center 
                    w-12 h-12 sm:w-16 sm:h-16 md:w-24 md:h-24
                    shadow-bottomSm border-2 border-black 
                    bg-white rounded-full">
            <p class="text-base sm:text-xl md:text-5xl font-jost font-semibold">
                {{ $position }}
            </p>
        </div>

        {{-- NAME --}}
        <div class="sm:text-2xl md:ml-6 md:text-4xl font-medium font-jost text-white">
            {{ $rankUser->name }}
        </div>

        {{-- RIGHT BOX --}}
        <div class="flex items-center sm:w-32 sm:h-16 md:w-64 md:h-24 ml-auto shadow-lg border-2 border-black rounded-full px-6"
             style="background: {{ $rankUser->rank->gradient() }}">

            {{-- BADGE IMAGE --}}
            <img src="{{ $rankUser->rank->badge() }}"
                 class="hidden sm:w-4 md:w-16 md:h-22 md:flex mr-4">

            {{-- POINT --}}
            <div class="sm:ml-auto md:m-auto text-white sm:text-2xl md:text-5xl font-semibold">
                {{ $rankUser->xp }}
            </div>
        </div>

    </div>
</div>
