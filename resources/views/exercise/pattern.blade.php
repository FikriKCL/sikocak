<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Level {{ $exerciseIndex + 1 }} - Pattern Recognition</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F5F0] min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <header class="flex justify-between items-center mb-8">
            <a href="{{ route('dashboard') }}" class="bg-white px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                <span class="text-xl font-black">← Kembali</span>
            </a>
            
            <div class="bg-[#CCFF00] px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <h1 class="text-2xl font-black text-black">Level {{ $exerciseIndex + 1 }}</h1>
            </div>

            <div class="bg-[#FF9966] px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="text-xl font-black text-black">{{ $user->xp }} XP</span>
            </div>
        </header>

        <div class="max-w-4xl mx-auto">
            {{-- Tambah pengecekan jika data belum di-migrate --}}
            @if(!$exercise->options || !$exercise->exerciseSteps || $exercise->exerciseSteps->count() === 0)
            <div class="bg-[#FF9966] p-8 rounded-3xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="text-2xl font-black mb-4">Data Soal Belum Tersedia</h2>
                <p class="text-lg mb-4">Silakan jalankan migration dan seeder terlebih dahulu:</p>
                <div class="bg-black text-white p-4 rounded-lg font-mono text-sm">
                    <p>php artisan migrate</p>
                    <p>php artisan db:seed --class=ExerciseLevelSeeder</p>
                </div>
            </div>
            @else
            
            @if($alreadyCompleted)
            <div class="mb-6 bg-[#CCFF00] p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    <span class="text-xl font-black">Anda sudah menyelesaikan level ini!</span>
                </div>
            </div>
            @endif

            <form action="{{ route('exercise.submit', $exercise->id) }}" method="POST">
                @csrf
                
                <div class="bg-white rounded-3xl border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h2 class="text-3xl font-black mb-8 text-black text-center">{{ $exercise->question_text }}</h2>
                    
                    @php
                        $step = $exercise->exerciseSteps->first();
                        $pattern = $step->step_options['pattern'] ?? [];
                    @endphp
                    
                    <!-- Display Pattern -->
                    <div class="mb-10 p-8 bg-gray-50 rounded-2xl border-3 border-black">
                        <p class="text-lg font-black mb-6 text-center">Pola Saat Ini:</p>
                        <div class="flex justify-center gap-3 flex-wrap">
                            @foreach($pattern as $color)
                            <div class="flex flex-col items-center">
                                <img src="{{ asset('images/monster.png') }}" alt="Monster" 
                                     class="w-20 h-20" 
                                     style="filter: {{ $color === 'green' ? 'hue-rotate(90deg) saturate(2)' : 'brightness(1.5) saturate(0)' }}">
                                <span class="text-sm font-bold mt-2">{{ $color === 'green' ? 'Hijau' : 'Putih' }}</span>
                            </div>
                            @endforeach
                            <div class="flex items-center justify-center text-4xl font-black text-gray-400">
                                ...
                            </div>
                        </div>
                    </div>
                    
                    <!-- Answer Options -->
                    <div class="space-y-4">
                        <p class="text-xl font-black text-center mb-6">Pilih pola selanjutnya:</p>
                        
                        @foreach($exercise->options as $option)
                        <label class="block cursor-pointer">
                            <input type="radio" name="answers[{{ $step->id }}]" value="{{ $option['id'] }}" class="hidden peer" required>
                            <div class="p-6 bg-white rounded-2xl border-4 border-black hover:bg-[#CCFF00] peer-checked:bg-[#CCFF00] peer-checked:scale-105 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                <div class="flex items-center gap-4">
                                    <span class="text-2xl font-black">{{ $option['label'] }}</span>
                                    <div class="flex gap-2 ml-auto">
                                        @foreach($option['colors'] as $color)
                                        <img src="{{ asset('images/monster.png') }}" alt="Monster" 
                                             class="w-16 h-16" 
                                             style="filter: {{ $color === 'green' ? 'hue-rotate(90deg) saturate(2)' : 'brightness(1.5) saturate(0)' }}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center mt-8">
                    <button type="submit" class="bg-[#CCFF00] hover:bg-[#B8E600] px-12 py-6 rounded-full border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[4px] hover:translate-y-[4px] transition-all">
                        <span class="text-2xl font-black text-black">Periksa Jawaban</span>
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="fixed bottom-8 right-8 bg-[#CCFF00] px-8 py-4 rounded-2xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] animate-bounce z-50">
        <p class="text-xl font-black text-black">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="fixed bottom-8 right-8 bg-[#FF9966] px-8 py-4 rounded-2xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] z-50">
        <p class="text-xl font-black text-black">{{ session('error') }}</p>
    </div>
    @endif
</body>
</html>