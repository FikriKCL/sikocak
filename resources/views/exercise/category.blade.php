<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Level {{ $exerciseIndex + 1 }} - Kategori</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F5F5F0] min-h-screen">

<div class="max-w-7xl mx-auto px-4 py-6">

<!-- HEADER -->
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

<div class="max-w-5xl mx-auto">

@if($alreadyCompleted)
<div class="mb-6 bg-[#CCFF00] p-5 md:p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0]">
    <div class="flex items-center gap-3">
        <svg class="w-7 h-7 md:w-8 md:h-8 text-black" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
        </svg>
        <span class="text-lg md:text-xl font-black">
            Anda sudah menyelesaikan level ini!
        </span>
    </div>
</div>
@endif

<form action="{{ route('exercise.submit', $exercise->id) }}" method="POST">
@csrf

@php
    $step = $exercise->exerciseSteps->first();
@endphp

<!-- CARD -->
<div class="bg-white rounded-3xl border-4 border-black p-6 md:p-8 shadow-[8px_8px_0]">
    <h2 class="text-xl md:text-3xl font-black mb-8 md:mb-10 text-black text-center">
        {{ $exercise->question_text }}
    </h2>

    <!-- OPTIONS GRID -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
        @foreach($exercise->options as $option)
        <label class="cursor-pointer group">
            <input type="radio"
                   name="answers[{{ $step->id }}]"
                   value="{{ $option['id'] }}"
                   class="hidden peer"
                   required>

            <div class="bg-white rounded-3xl border-4 border-black
                        p-4 md:p-6
                        hover:bg-[#CCFF00]
                        peer-checked:bg-[#CCFF00]
                        peer-checked:scale-105
                        transition-all
                        shadow-[6px_6px_0]
                        hover:shadow-[4px_4px_0]">

                <div class="aspect-square bg-gray-100 rounded-2xl border-3 border-black
                            mb-3 md:mb-4
                            flex items-center justify-center overflow-hidden">
                    <img src="{{ asset($option['image']) }}"
                         class="w-full h-full object-cover">
                </div>

                <p class="text-center text-base md:text-lg font-black">
                    {{ $option['name'] }}
                </p>
            </div>
        </label>
        @endforeach
    </div>
</div>

<!-- BUTTON -->
<div class="flex justify-center mt-8">
    <button type="submit"
        class="w-full md:w-auto
               bg-[#CCFF00] hover:bg-[#B8E600]
               px-10 md:px-12 py-5 md:py-6
               rounded-full border-4 border-black
               shadow-[8px_8px_0]
               hover:shadow-[4px_4px_0]
               hover:translate-x-[4px]
               hover:translate-y-[4px]
               transition-all">
        <span class="text-xl md:text-2xl font-black text-black">
            Periksa Jawaban
        </span>
    </button>
</div>

</form>
</div>
</div>

<!-- TOAST -->
@if(session('success'))
<div class="fixed bottom-6 right-4 md:right-8
            bg-[#CCFF00] px-6 md:px-8 py-4
            rounded-2xl border-4 border-black
            shadow-[8px_8px_0]
            animate-bounce z-50">
    <p class="text-lg md:text-xl font-black text-black">
        {{ session('success') }}
    </p>
</div>
@endif

@if(session('error'))
<div id="toast-error" class="fixed bottom-6 right-4 md:right-8
            bg-[#FF9966] px-6 md:px-8 py-4
            rounded-2xl border-4 border-black
            shadow-[8px_8px_0] z-50">
    <p class="text-lg md:text-xl font-black text-black">
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
