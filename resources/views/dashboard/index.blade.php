<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cania Cita - Dashboard Pembelajaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F5F0] min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <!-- Logo/Brand -->
            <div class="flex items-center gap-3 bg-[#FF9966] px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <h1 class="text-2xl font-black text-black">Cania Cita</h1>
                <div class="w-10 h-10 bg-white rounded-full border-3 border-black flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            <!-- Badge SiKocak -->
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="text-xl font-black text-black">SiKocak</span>
                <div class="w-12 h-12 bg-white rounded-full border-3 border-black flex items-center justify-center">
                    <span class="text-lg font-black">{{ $progressPercentage }}%</span>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Section - Lessons -->
            <div class="space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-3xl border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <div class="flex flex-col items-center">
                        <!-- Avatar with Rings -->
                        <div class="relative mb-4">
                            <div class="absolute inset-0 rounded-full border-4 border-[#FF9966] animate-pulse"></div>
                            <div class="absolute inset-[-8px] rounded-full border-4 border-[#FF9966] opacity-60"></div>
                            <div class="absolute inset-[-16px] rounded-full border-4 border-[#FF9966] opacity-30"></div>
                            @if($user->imageUrl)
                                <img src="{{ $user->imageUrl }}" alt="{{ $user->name }}" class="relative w-32 h-32 rounded-full border-4 border-black object-cover z-10">
                            @else
                                <div class="relative w-32 h-32 rounded-full border-4 border-black bg-[#FF9966] flex items-center justify-center z-10">
                                    <svg class="w-16 h-16 text-black" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Rank Badge -->
                        <div class="bg-[#CC6633] px-8 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <span class="text-xl font-black text-white">
                                {{ $user->rank ? $user->rank->name : 'Pemula' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Lessons Panel -->
                <div class="bg-white rounded-3xl border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h2 class="text-2xl font-black mb-4 text-center border-b-4 border-black pb-3">Materi</h2>
                    <div class="space-y-3">
                        @forelse($lessons->take(4) as $index => $lesson)
                        <a 
                            href="{{ route('lesson.show', $lesson->id) }}"
                            class="block w-full bg-[#CCFF00] hover:bg-[#B8E600] px-6 py-4 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                        >
                            <span class="text-xl font-black text-black">{{ $lesson->name }}</span>
                        </a>
                        @empty
                        <p class="text-center text-gray-500">Belum ada materi tersedia</p>
                        @endforelse
                    </div>
                </div>

                <!-- Trophy Score -->
                <div class="bg-[#FF9966] rounded-3xl border-4 border-black px-8 py-4 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex items-center gap-4">
                    <div class="w-12 h-12 bg-white rounded-full border-3 border-black flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <span class="text-3xl font-black text-black">{{ $totalScore }}</span>
                </div>
            </div>

            <!-- Right Section - Exercises Level Path -->
            <div class="space-y-6">
                <!-- Main Level Button -->
                <div class="flex flex-col items-center gap-6">
                    <!-- Mascot -->
                    <div class="relative animate-bounce">
                        <div class="w-20 h-24 bg-[#CCFF00] rounded-t-full border-4 border-black relative">
                            <!-- Eye -->
                            <div class="absolute top-4 left-1/2 -translate-x-1/2 w-10 h-10 bg-white rounded-full border-3 border-black">
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5 bg-black rounded-full"></div>
                            </div>
                            <!-- Bottom wave -->
                            <div class="absolute bottom-0 left-0 right-0 h-4 bg-[#CCFF00] border-t-4 border-black" style="clip-path: polygon(0 50%, 25% 0, 50% 50%, 75% 0, 100% 50%, 100% 100%, 0 100%);"></div>
                        </div>
                    </div>

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
