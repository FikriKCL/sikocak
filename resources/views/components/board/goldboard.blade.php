@props(['ranks', 'position'])
    <div class="hover:scale-105 transition delay-100 duration-200 ease-in-out hover:-translate-y-1 mt-10 place-self-center w-3/4 h-32 shadow-bottomSm border-2 border-black bg-[linear-gradient(to_right,#796120,#AF8C2E,#DFB33B)] overflow-hidden rounded-full">
        <div class="flex items-center h-full px-6 gap-6">
                {{-- NUMBERING --}}
            <div class="flex items-center w-24 h-24 shadow-bottomSm border-2 border-black bg-white rounded-full"><p class="text-5xl font-jost ml-8 font-semibold select-none">{{$position}}</p>
            </div>
                {{-- NAME --}}
            <div class="ml-6 text-4xl font-medium font-jost text-white select-none">{{$ranks->name}}</div>
            <div class="flex items-center w-64 h-24 ml-auto shadow-lg border-2 border-black bg-[linear-gradient(to_right,#796120,#AF8C2E,#DFB33B)] rounded-full px-6">
                {{-- IMAGE --}}
                <img src="/images/gold.png" class="w-16 h-22 mr-4 select-none" alt="My Image">
                {{-- POINT --}}
                <div class="ml-8 text-white text-5xl font-semibold select-none">{{$ranks->xp}}</div>
            </div>
        </div>