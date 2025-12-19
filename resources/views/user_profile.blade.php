@props(['users'])
<x-app-layout>
    <div class="h-screen">
        @if ($users->id_rank == 5)
            <x-profile.kuarsa-profile :user="$users" />
        @elseif ($users->id_rank == 4)
            <x-profile.diamond-profile :user="$users" />
        @elseif ($users->id_rank == 3)
            <x-profile.gold-profile :user="$users" />
        @elseif ($users->id_rank == 2)
            <x-profile.silver-profile :user="$users" />
        @else
            <x-profile.bronze-profile :user="$users" />
        @endif

        <form action="{{ route('logout') }}" method="POST" class="flex justify-center mt-4">
    @csrf
        <button type="submit"
            class="w-32 h-12 bg-[#FF5C5C] border-2 border-black rounded-full 
                shadow-bottomSm py-2 text-lg font-semibold">
            Logout
        </button>
    </form>
    </div>
</x-app-layout>
