@props(['ranks', 'position'])

<div class="hover:scale-105 transition delay-100 duration-200 ease-in-out hover:-translate-y-1 mt-10 place-self-center w-3/4 h-32 shadow-bottomSm border-2 border-black bg-[linear-gradient(to_left,#B6511B,#FF9258,#C45013,#45220F)] overflow-hidden rounded-full">
    <div class="flex items-center h-full px-6 gap-6">

        {{-- NUMBERING --}}
                <div class="flex items-center justify-center w-24 h-24 
                        shadow-bottomSm border-2 border-black 
                        bg-white rounded-full">
                <p class="text-5xl font-jost font-semibold select-none">
                    {{ $position }}
                </p>
            </div>

        {{-- NAME --}}
        <div class="sm:text-2xl md:ml-6 md:text-4xl font-medium font-jost text-white select-none">{{ $ranks->name }}</div>

        {{-- RIGHT CONTAINER --}}
        <div class="flex items-center sm:w-32 sm:h-16 md:w-64 md:h-24 ml-auto shadow-lg border-2 border-black bg-[linear-gradient(to_right,#B6511B,#FF9258,#C45013,#45220F)] rounded-full px-6">

            {{-- IMAGE --}}
            <img src="/images/bronze.png" class="sm:w-4 md:w-16 md:h-22 mr-4 select-none" alt="My Image">

            {{-- POINT --}}
            <div class="sm:ml-auto md:m-auto text-white sm:text-2xl md:text-5xl font-semibold select-none">{{ $ranks->xp }}</div>
        </div>

    </div>
</div>
