<x-app-layout>
    <div class="py-12">

        <div class="max-w-screen-md mx-auto sm:px-6 lg:px-8 pt-12">
            <div class="flex items-center justify-center gap-6">

                <div class="w-12 h-12 bg-[#9DFF00] rounded-full border-2 border-black shadow-bottomSm">
                    <button class="place-self-center px-2 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                </div>

                <div class="place-self-center w-96 shadow-bottomSm border-2 border-black bg-white overflow-hidden rounded-full">
                    <div class="p-6 text-gray-900 text-center font-semibold text-2xl font-jostt">
                        {{ ("Papan Peringkat") }}
                    </div>
                </div>

            </div>
        </div>

        @php
            $position = ($ranking->currentPage() - 1) * $ranking->perPage() + 1;
        @endphp

       @foreach($ranking as $user)
            @if ($user->xp >= 500)
            <div class="mb-6">
                <x-board.quartzboard :ranks="$user" :position="$position" />
            </div>
            @elseif($user->xp >= 400)
            <div class="mb-6">
                <x-board.diamondboard :ranks="$user" :position="$position" />
            </div>
            @elseif($user->xp >= 300)
            <div class="mb-6">
                <x-board.goldboard :ranks="$user" :position="$position" />
            </div>
            @elseif($user->xp >= 200)
            <div class="mb-6">
                <x-board.silverboard :ranks="$user" :position="$position" />
            </div>
            @else
            <div class="mb-6">
                <x-board.bronzeboard :ranks="$user" :position="$position" />
            </div>
                @endif 

            @php $position++; @endphp
        @endforeach

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $ranking->links() }}
        </div>

    </div>
</x-app-layout>
