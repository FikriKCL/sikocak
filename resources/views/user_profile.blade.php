@props(['users'])
<x-app-layout>
    <div class="h-screen overflow-hidden">
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
    </div>
</x-app-layout>
