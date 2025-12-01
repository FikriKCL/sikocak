<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Level {{ $exerciseIndex + 1 }} - Cania Cita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F5F0] min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
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

        <!-- Exercise Content -->
        <div class="max-w-4xl mx-auto">
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

            <form action="{{ route('exercise.submit', $exercise->id) }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="bg-white rounded-3xl border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <!-- Exercise Info -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-[#FF9966] inline-block px-6 py-2 rounded-full border-3 border-black">
                            <span class="text-lg font-black">{{ $exercise->skill->name }}</span>
                        </div>
                        
                        <div class="bg-gray-100 px-6 py-2 rounded-full border-3 border-black">
                            <span class="text-sm font-black">{{ $exercise->exerciseSteps->count() }} Soal</span>
                        </div>
                    </div>
                    
                    <!-- Question -->
                    <h2 class="text-3xl font-black mb-8 text-black">{{ $exercise->question_text }}</h2>
                    
                    <!-- Exercise Steps -->
                    @foreach($exercise->exerciseSteps as $stepIndex => $step)
                    <div class="mb-6 p-6 bg-gray-50 rounded-2xl border-3 border-black">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="bg-[#CCFF00] w-10 h-10 rounded-full border-3 border-black flex items-center justify-center flex-shrink-0">
                                <span class="text-lg font-black">{{ $step->step_number }}</span>
                            </div>
                            <p class="text-lg font-semibold text-black flex-1">{{ $step->content }}</p>
                        </div>
                        
                        <!-- Input text untuk jawaban -->
                        <div class="ml-14">
                            <input 
                                type="text" 
                                name="answers[{{ $step->id }}]" 
                                placeholder="Ketik jawabanmu di sini..."
                                class="w-full px-6 py-4 rounded-2xl border-4 border-black text-lg font-semibold focus:outline-none focus:ring-4 focus:ring-[#CCFF00] bg-white"
                                required
                                @if(session('user_answers') && isset(session('user_answers')[$step->id]))
                                    value="{{ session('user_answers')[$step->id] }}"
                                @endif
                            >
                            
                            <!-- Menampilkan feedback jika ada error -->
                            @if(session('errors_detail') && isset(session('errors_detail')[$step->id]))
                            <div class="mt-2 flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                </svg>
                                <div>
                                    <p class="text-red-600 font-semibold">Jawaban Anda: <span class="font-black">{{ session('user_answers')[$step->id] }}</span></p>
                                    <p class="text-green-600 font-semibold">Jawaban yang benar: <span class="font-black">{{ $step->answer }}</span></p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button 
                        type="submit"
                        class="bg-[#CCFF00] hover:bg-[#B8E600] px-12 py-6 rounded-full border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[4px] hover:translate-y-[4px] transition-all"
                    >
                        <span class="text-2xl font-black text-black">Periksa Jawaban</span>
                    </button>
                </div>
            </form>
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
