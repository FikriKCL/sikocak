<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $lesson->name }} - Cania Cita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F5F0] min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <a href="{{ route('dashboard') }}" class="bg-white px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                <span class="text-xl font-black">← Kembali</span>
            </a>
            
            <div class="bg-[#FF9966] px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <h1 class="text-2xl font-black text-black">{{ $lesson->name }}</h1>
            </div>

            <div class="w-20"></div>
        </header>

        <!-- Lesson Content -->
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Lesson Info Card -->
            <div class="bg-white rounded-3xl border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="flex items-center justify-between mb-6">
                    <div class="bg-[#CCFF00] inline-block px-6 py-2 rounded-full border-3 border-black">
                        <span class="text-lg font-black">Materi Pembelajaran</span>
                    </div>
                    
                    <div class="bg-[#FF9966] px-6 py-2 rounded-full border-3 border-black">
                        <span class="text-lg font-black">Level {{ $lesson->difficulty_level }}</span>
                    </div>
                </div>
                
                <h2 class="text-3xl font-black mb-4 text-black">{{ $lesson->name }}</h2>
                
                @if($lesson->progress)
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-bold text-gray-600">Progress</span>
                        <span class="text-sm font-bold text-gray-600">{{ $lesson->progress }}%</span>
                    </div>
                    <div class="w-full h-4 bg-gray-200 rounded-full border-2 border-black overflow-hidden">
                        <div class="h-full bg-[#CCFF00] transition-all duration-300" style="width: {{ $lesson->progress }}%"></div>
                    </div>
                </div>
                @endif

                <div class="prose max-w-none">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Selamat datang di materi <strong>{{ $lesson->name }}</strong>! 
                        Pada materi ini, Anda akan mempelajari berbagai konsep penting dalam bahasa Indonesia.
                    </p>
                    
                    @if($lesson->status === 'completed')
                    <div class="mt-6 bg-[#CCFF00] p-6 rounded-2xl border-4 border-black">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            <span class="text-xl font-black">Materi ini sudah diselesaikan!</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Related Exercises -->
            @if($lesson->course && $lesson->course->skills)
            <div class="bg-white rounded-3xl border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-2xl font-black mb-6 text-black border-b-4 border-black pb-3">Latihan Terkait</h3>
                
                <p class="text-lg text-gray-700 mb-6">
                    Untuk menguasai materi ini, silakan kerjakan latihan-latihan yang tersedia di halaman utama dashboard.
                </p>

                <a 
                    href="{{ route('dashboard') }}" 
                    class="inline-block bg-[#CCFF00] hover:bg-[#B8E600] px-8 py-4 rounded-full border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                >
                    <span class="text-xl font-black text-black">Mulai Latihan</span>
                </a>
            </div>
            @endif
        </div>
    </div>
</body>
</html>
