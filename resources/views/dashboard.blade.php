<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <form action="{{ route('logout') }}" method="POST" class="flex justify-center mt-4">
    @csrf
        <button type="submit"
            class="w-32 h-12 bg-[#FF5C5C] border-2 border-black rounded-full 
                shadow-bottomSm py-2 text-lg font-semibold">
            Logout
        </button>
    </form>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
