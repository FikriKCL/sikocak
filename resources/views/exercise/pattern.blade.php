<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Level {{ $exerciseIndex + 1 }} - Pattern Recognition</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F5F5F0] min-h-screen overflow-x-hidden">

<div class="max-w-6xl mx-auto px-3 sm:px-6 py-4 sm:py-6">

    <!-- ================= HEADER ================= -->
 <header class="flex justify-between items-center mb-6 px-2 sm:px-0">

    <!-- KEMBALI -->
    <a href="{{ route('dashboard') }}"
       class="bg-white px-3 sm:px-6 py-2 sm:py-3 rounded-full border-4 border-black
              shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]
              hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]
              transition-all text-center">
        <span class="text-sm sm:text-xl font-black">← Kembali</span>
    </a>

    <!-- LEVEL -->
    <div class="bg-[#CCFF00] px-3 sm:px-6 py-2 sm:py-3 rounded-full border-4 border-black
                shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-center">
        <h1 class="text-sm sm:text-2xl font-black">Level {{ $exerciseIndex + 1 }}</h1>
    </div>

    <!-- XP -->
    <div class="bg-[#FF9966] px-3 sm:px-6 py-2 sm:py-3 rounded-full border-4 border-black
                shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-center">
        <span class="text-sm sm:text-xl font-black">{{ $user->xp }} XP</span>
    </div>

</header>

    <!-- ================= CONTENT ================= -->
    <div class="max-w-4xl mx-auto">

        <form action="{{ route('exercise.submit', $exercise->id) }}" method="POST">
            @csrf

            <div class="bg-white rounded-3xl border-4 border-black
                        p-4 sm:p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

                <!-- QUESTION -->
                <h2 class="text-lg sm:text-2xl lg:text-3xl font-black
                           mb-6 sm:mb-8 text-center">
                    {{ $exercise->question_text }}
                </h2>

                @php
                    $step = $exercise->exerciseSteps->first();
                    $pattern = $step->step_options['pattern'] ?? [];
                @endphp

                <!-- ================= PATTERN ================= -->
                <div class="mb-8 p-4 sm:p-6 bg-gray-50 rounded-2xl border-2 border-black">
                    <p class="text-base sm:text-lg font-black mb-4 text-center">
                        Pola Saat Ini:
                    </p>

                    <div class="flex justify-center gap-2 sm:gap-4 flex-wrap">
                        @foreach($pattern as $color)
                            <div class="flex flex-col items-center">
                                <img src="{{ asset('images/monster.webp') }}"
                                     alt="Monster"
                                     class="w-12 h-12 sm:w-20 sm:h-20"
                                     style="filter: {{ $color === 'green'
                                        ? 'hue-rotate(90deg) saturate(0)'
                                        : 'brightness(1.5) saturate(0)' }}">

                                <span class="text-xs sm:text-sm font-bold mt-1">
                                    {{ $color === 'green' ? 'Hijau' : 'Putih' }}
                                </span>
                            </div>
                        @endforeach

                        <div class="flex items-center text-3xl sm:text-4xl
                                    font-black text-gray-400">
                            ...
                        </div>
                    </div>
                </div>

                <!-- ================= OPTIONS ================= -->
                <p class="text-base sm:text-xl font-black text-center mb-4 sm:mb-6">
                    Pilih pola selanjutnya:
                </p>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                    @foreach($exercise->options as $option)
                        <label class="cursor-pointer">
                            <input type="radio"
                                   name="answers[{{ $step->id }}]"
                                   value="{{ $option['id'] }}"
                                   class="hidden peer"
                                   required>

                            <div class="p-4 sm:p-6 bg-white rounded-2xl border-4 border-black
                                        hover:bg-[#CCFF00] peer-checked:bg-[#CCFF00]
                                        transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">

                                <div class="flex flex-col sm:flex-row
                                            items-center gap-3 sm:gap-4">

                                    <span class="text-lg sm:text-xl font-black">
                                        {{ $option['label'] }}
                                    </span>

                                    <div class="flex gap-2 sm:gap-3
                                                sm:ml-auto justify-center sm:justify-end">
                                        @foreach($option['colors'] as $color)
                                            <img src="{{ asset('images/monster.webp') }}"
                                                 class="w-12 h-12 sm:w-16 sm:h-16"
                                                 style="filter: {{ $color === 'green'
                                                    ? 'hue-rotate(90deg) saturate(2)'
                                                    : 'brightness(1.5) saturate(0)' }}">
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </label>
                    @endforeach

                </div>
            </div>

            <!-- ================= BUTTON ================= -->
            <div class="flex justify-center mt-6 sm:mt-8">
                <button type="submit"
                        class="w-full sm:w-auto bg-[#CCFF00] hover:bg-[#B8E600]
                               px-8 sm:px-12 py-4 sm:py-6 rounded-full
                               border-4 border-black
                               shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]
                               hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]
                               transition-all">
                    <span class="text-lg sm:text-2xl font-black">
                        Periksa Jawaban
                    </span>
                </button>
            </div>

        </form>
    </div>
</div>


<!-- ================= TOAST ================= -->
@if(session('success'))
<div class="fixed bottom-4 inset-x-4 sm:inset-x-auto sm:right-8
            bg-[#CCFF00] px-6 py-3 rounded-2xl
            border-4 border-black shadow-lg z-50">
    <p class="text-base sm:text-lg font-black text-center">
        {{ session('success') }}
    </p>
</div>
@endif

@if(session('error'))
<div id="toast-error" class="fixed bottom-4 inset-x-4 sm:inset-x-auto sm:right-8
            bg-[#FF9966] px-6 py-3 rounded-2xl
            border-4 border-black shadow-lg z-50">
    <p class="text-base sm:text-lg font-black text-center">
        {{ session('error') }}
    </p>
</div>
@endif

<script>
       setTimeout(() => {
        const toast = document.getElementById('toast-error');
        if(toast){
            toast.style.transition = 'opacity 0.5s ease';
            toast.style.opacity = 0;
            setTimeout(() => toast.remove(), 500); 
        }
    }, 1000);
</script>

</body>
</html>
