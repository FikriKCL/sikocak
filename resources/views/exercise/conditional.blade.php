<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Level {{ $exerciseIndex + 1 }} - Logika Kondisi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        .traffic-light-red {
            background-color: #EF4444;
            animation: blink 1.5s infinite;
        }
        .traffic-light-yellow {
            background-color: #FCD34D;
        }
        .traffic-light-green {
            background-color: #10B981;
        }
    </style>
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

        <div class="max-w-5xl mx-auto">
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

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Traffic Light Section -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-3xl border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                        <h3 class="text-2xl font-black mb-6 text-center">Lampu Lalu Lintas</h3>
                        
                        <!-- Road Scene -->
                        <div class="relative bg-gray-700 rounded-2xl border-4 border-black p-8 h-96 overflow-hidden">
                            <!-- Road -->
                            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gray-600 border-t-4 border-yellow-400"></div>
                            
                            <!-- Traffic Light -->
                            <div class="absolute top-8 right-1/2 transform translate-x-1/2 bg-black rounded-2xl p-4 w-24">
                                <div class="flex flex-col gap-3">
                                    <div class="w-16 h-16 rounded-full border-4 border-black traffic-light-red"></div>
                                    <div class="w-16 h-16 rounded-full bg-gray-800 border-4 border-black"></div>
                                    <div class="w-16 h-16 rounded-full bg-gray-800 border-4 border-black"></div>
                                </div>
                            </div>
                            
                            <!-- Car -->
                            <div class="absolute bottom-36 left-8">
                                <div class="w-32 h-20 bg-blue-500 rounded-lg border-4 border-black relative">
                                    <div class="absolute -top-8 left-4 w-20 h-12 bg-blue-400 rounded-t-lg border-4 border-black"></div>
                                    <div class="absolute -bottom-4 left-2 w-6 h-6 bg-black rounded-full"></div>
                                    <div class="absolute -bottom-4 right-2 w-6 h-6 bg-black rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Answer Section -->
                <div class="md:col-span-1">
                    <form action="{{ route('exercise.submit', $exercise->id) }}" method="POST">
                        @csrf
                        
                        @php
                            $step = $exercise->exerciseSteps->first();
                        @endphp
                        
                        <div class="bg-white rounded-3xl border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                            <h2 class="text-2xl font-black mb-6 text-black">{{ $exercise->question_text }}</h2>
                            
                            <div class="space-y-4">
                                @foreach($exercise->options as $option)
                                <label class="block cursor-pointer">
                                    <input type="radio" name="answers[{{ $step->id }}]" value="{{ $option['id'] }}" class="hidden peer" required>
                                    <div class="p-6 bg-gray-50 rounded-2xl border-4 border-black hover:bg-[#CCFF00] peer-checked:bg-[#CCFF00] peer-checked:scale-105 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                        <p class="text-2xl font-black text-center">{{ $option['text'] }}</p>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            
                            <button type="submit" class="w-full mt-6 bg-[#CCFF00] hover:bg-[#B8E600] px-8 py-4 rounded-full border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                                <span class="text-xl font-black text-black">Jawab</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
