<x-app-layout>
    <div class="py-4 !scroll-smooth">

        <div class="max-w-screen-md mx-auto sm:px-6 lg:px-8 pt-12">
            <div class="flex items-center justify-center gap-6">
                   <a href="{{ route('dashboard') }}">
                        <div class="w-12 h-12 bg-[#9DFF00] rounded-full border-2 border-black shadow-bottomSm flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </div>
                    </a>
        

                <div class="place-self-center w-96 shadow-bottomSm border-2 border-black bg-white overflow-hidden rounded-full">
                    <div class="p-6 text-gray-900 text-center font-semibold text-2xl font-jostt">
                        {{ ("Papan Peringkat") }}
                    </div>
                </div>

            </div>
        </div>

        @php 
        $position = 1; 
        @endphp

        @foreach ($ranking as $user)
            <div class="mb-6">
                <x-board.rank-board :rankUser="$user" :position="$position"/>
            </div>

            @php $position++; @endphp
        @endforeach

</x-app-layout>
