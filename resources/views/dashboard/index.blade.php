@props(['progressPercentage','user', 'streak'])
<!DOCTYPE html>
<html lang="id">
<head>
          {{-- <-- INI COMMENT --> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIKOCAK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F5F0] min-h-screen">
        @if (session('popup_message'))
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-3xlxl p-6 w-80 text-center border-4 border-black">
            <h2 class="text-xl font-black mb-2">
                {{ session('popup_title') }}
            </h2>
            <p class="mb-4">
                {{ session('popup_message') }}
            </p>
            <button 
                onclick="this.closest('div').parentElement.remove()"
                class="px-4 py-2 bg-[#CCFF00] border-2 border-black rounded"
            >
                OK
            </button>
        </div>
    </div>
    @endif

    <div class="mx-auto py-6">
        <!-- Header -->
      <header class="w-full mb-8">
            <div class="flex items-center justify-between gap-4">
                <x-dashboard.player-header :user="$user" :header="$header"/>
                <x-dashboard.streak-card :user="$user"/>
            </div>
        </header>


        <div class="grid grid-cols-1 lg:grid-cols-2 px-4 gap-8 items-start">
            <!-- Left Section - Lessons -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- ===================== -->
    <!-- KOLOM KIRI (2 kolom) -->
    <!-- ===================== -->
    <div class="space-y-6 lg:col-span-2">

        <!-- Profile Card -->
        <a href="{{ route('leaderboard.index') }}">
            <x-dashboard.player-card :user="$user" :header="$header"/>
        </a>

        <!-- Trophy Score -->
        <x-dashboard.trophy-card :user="$user" :header="$header"/>

    </div>

    <!-- ====================== -->
    <!-- KOLOM KANAN: MATERI    -->
    <!-- ====================== -->
    <div class="bg-white rounded-3xl border-4 border-black p-6 
                shadow-[8px_8px_0px_rgba(0,0,0,1)] flex flex-col">

        <h2 class="text-2xl font-black text-center mb-4 border-b-4 border-black pb-3">
            Materi
        </h2>

        <div class="flex flex-col space-y-4 flex-1 justify-center">

            @forelse($lessons as $index => $lesson)
            <a 
                href="{{ route('lesson.show', $lesson->id) }}"
                class="bg-[#CCFF00] hover:bg-[#B8E600]
                       px-6 py-3 rounded-full border-4 border-black
                       shadow-[4px_4px_0px_rgba(0,0,0,1)]
                       hover:shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       hover:translate-x-[2px] hover:translate-y-[2px]
                       transition-all text-center"
            >
                <span class="text-lg font-black text-black">
                    {{ $lesson->name ?? 'Materi-' . ($index + 1) }}
                </span>
            </a>
            @empty
            <p class="text-center text-gray-500">Belum ada materi tersedia</p>
            @endforelse

        </div>
    </div>

</div>


            <!-- Right Section - Exercises Level Path -->
            <div class="space-y-6">
                <!-- Main Level Button -->
                <div class="flex flex-col items-center gap-6">

                    <x-dashboard.sikocak-header :progressPercentage="$progressPercentage" />

                <div class="flex flex-row items-center ml-20">
                    
                    <!-- Play Button -->
                    @if($currentExercise)
                    <a 
                        href="{{ route('exercise.show', $currentExercise->id) }}"
                        class="relative group block"
                    >
                        <!-- Outer Ring -->
                        <div class="absolute inset-0 rounded-full border-8 border-[#CCFF00] animate-pulse"></div>
                        
                        <!-- Main Button -->
                        <div class="relative w-48 h-48 bg-white rounded-full border-8 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group-hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] group-hover:translate-x-[4px] group-hover:translate-y-[4px] transition-all flex items-center justify-center">
                            <!-- Play Icon -->
                            <svg class="w-24 h-24 text-black" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </a>
                    @else
                    <div class="relative">
                        <div class="relative w-48 h-48 bg-gray-300 rounded-full border-8 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                    </div>
                    @endif

                    <!-- Mascot -->
                    <div class="relative animate-bounce">
                        <div class="w-20 h-24 ml-5">
                            <img src="/images/monster.png" alt="">
                        </div>
                    </div>

                    </div>

                    <!-- Level Badge -->
                    <div class="bg-[#CCFF00] px-12 py-4 rounded-full border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                        <span class="text-3xl font-black text-black">Level {{ $currentLevel }}</span>
                    </div>
                </div>

                <!-- Exercise Level Progression Path -->
                <div class="flex flex-col items-center gap-8 mt-12">
                    @forelse($exercises as $index => $exercise)
                    <div class="relative">
                        <!-- Connection Line -->
                        @if($index > 0)
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 w-1 h-8 bg-gray-300 border-2 border-black"></div>
                        @endif
                        
                        <!-- Level Node -->
                        @if($exercise->status === 'locked')
                        <div class="relative bg-gray-300 w-24 h-24 rounded-full border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center opacity-50">
                            <!-- Locked Icon -->
                            <svg class="w-12 h-12 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                        </div>
                        @else
                        <a 
                            href="{{ route('exercise.show', $exercise->id) }}"
                            class="relative group block {{ $exercise->status === 'completed' ? 'bg-[#CCFF00]' : 'bg-white' }} w-24 h-24 rounded-full border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] transition-all flex items-center justify-center cursor-pointer"
                        >
                            @if($exercise->status === 'completed')
                                <!-- Check Mark -->
                                <svg class="w-12 h-12 text-black" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                            @else
                                <!-- Empty square (unlocked but not completed) -->
                                <div class="w-10 h-10 border-4 border-black rounded"></div>
                            @endif
                        </a>
                        @endif

                        <!-- Level Number -->
                        <div class="absolute -bottom-8 left-1/2 -translate-x-1/2 text-sm font-bold text-gray-600">
                            {{ $index + 1 }}
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-500">Belum ada exercise tersedia</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html>
