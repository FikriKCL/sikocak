<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Level {{ $exerciseIndex + 1 }} - Logika Kondisi</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
svg g {
    transition: transform 0.6s ease;
    transform-origin: center;
}

.crash {
    animation: crashShake 0.4s ease-in-out;
}

@keyframes crashShake {
    0%   { transform: translate(0, 0); }
    20%  { transform: translate(-4px, 2px); }
    40%  { transform: translate(4px, -2px); }
    60%  { transform: translate(-3px, 1px); }
    80%  { transform: translate(3px, -1px); }
    100% { transform: translate(0, 0); }
}
</style>
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

<!-- CONTENT -->
<div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Traffic Light / SVG Section -->
    <div class="md:col-span-2 flex justify-center">
        <div class="w-full max-w-full md:max-w-[700px]">
            @include('svg.level3')
        </div>
    </div>

    <!-- Answer Form -->
    <div class="md:col-span-1">
        <form id="exercise-form" action="{{ route('exercise.submit', $exercise->id) }}" method="POST">
            @csrf
            @php $step = $exercise->exerciseSteps->first(); @endphp

            <div class="bg-white rounded-3xl border-4 border-black p-5 sm:p-6 shadow-[8px_8px_0]">
                <h2 class="text-xl sm:text-2xl font-black mb-4 sm:mb-6 text-black">{{ $exercise->question_text }}</h2>

                <div class="space-y-3 sm:space-y-4">
                    @foreach($exercise->options as $option)
                    <label class="block cursor-pointer">
                        <input type="radio"
                               name="answers[{{ $step->id }}]"
                               value="{{ $option['id'] }}"
                               data-action="{{ strtolower($option['action']) }}"
                               class="hidden peer"
                               required
                        >
                        <div class="p-4 sm:p-6 bg-gray-50 rounded-2xl border-4 border-black
                                    hover:bg-[#CCFF00]
                                    peer-checked:bg-[#CCFF00]
                                    peer-checked:scale-105
                                    transition-all shadow-[4px_4px_0]">
                            <p class="text-xl sm:text-2xl font-black text-center">{{ $option['text'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>

                <!-- Optional: submit button if needed -->
                {{-- <button type="button" id="submit-btn" class="w-full mt-4 sm:mt-6 bg-[#CCFF00] hover:bg-[#B8E600] px-6 sm:px-8 py-3 sm:py-4 rounded-full border-4 border-black shadow-[6px_6px_0] hover:shadow-[4px_4px_0] hover:translate-x-[2px] hover:translate-y-[2px] transition-all text-xl sm:text-2xl font-black">Jawab</button> --}}
            </div>
        </form>
    </div>

</div>
</div>

<!-- TOASTS -->
@if(session('success'))
<div class="fixed bottom-6 right-4 sm:right-8 bg-[#CCFF00] px-6 sm:px-8 py-3 sm:py-4 rounded-2xl border-4 border-black shadow-[8px_8px_0] animate-bounce z-50">
    <p class="text-lg sm:text-xl font-black text-black">{{ session('success') }}</p>
</div>
@endif

@if(session('error'))
<div id="toast-error" class="fixed bottom-6 right-4 sm:right-8 bg-[#FF9966] px-6 sm:px-8 py-3 sm:py-4 rounded-2xl border-4 border-black shadow-[8px_8px_0] z-50">
    <p class="text-lg sm:text-xl font-black text-black">{{ session('error') }}</p>
</div>
@endif

</body>

<script>
document.addEventListener('DOMContentLoaded', () => {

    setTimeout(() => {
        const toast = document.getElementById('toast-error');
        if(toast){
            toast.style.transition = 'opacity 0.5s ease';
            toast.style.opacity = 0;
            setTimeout(() => toast.remove(), 500); 
        }
    }, 3000);
    

    const movementDuration = 650;   
    const crashDuration = 600;      
    const extraDelay = 800;         


    const cars = {
        red: document.getElementById('red-car'),
        yellow: document.getElementById('yellow-car'),
        violet: [
            document.getElementById('violet-car-1'),
            document.getElementById('violet-car-2'),
            document.getElementById('violet-car-3'),
        ],
        blue: [
            document.getElementById('blue-car-1'),
            document.getElementById('blue-car-2'),
        ],
    };
    const marking = document.getElementById('marking'); 
    const crashEffect = document.getElementById('crash-effect'); 
    const radios = document.querySelectorAll('input[type="radio"]');
    const form = document.getElementById('exercise-form');
    let locked = false;

    function crash(elements) {
        elements.forEach(el => {
            if (!el) return;
            el.classList.remove('crash');
            void el.offsetWidth;
            el.classList.add('crash');
            if (el.id === 'violet-car-2') {
                const bbox = el.getBBox();
                const cx = bbox.x + bbox.width / 2;
                const cy = bbox.y + bbox.height / 2;
                const transform = el.getAttribute('transform') || '';
                el.setAttribute('transform', `${transform} rotate(30 ${cx} ${cy})`);
                setTimeout(() => { el.setAttribute('transform', transform); }, 400);
            }
        });
    }

    function showCrashEffectOn(car, scale = 1) {
        if (!crashEffect || !car) return;
        car.parentNode.appendChild(crashEffect);
        const bbox = car.getBBox();
        crashEffect.setAttribute('x', bbox.x + bbox.width / 2 - (40 * scale));
        crashEffect.setAttribute('y', bbox.y - (60 * scale));
        crashEffect.setAttribute('width', 80 * scale);
        crashEffect.setAttribute('height', 80 * scale);
        crashEffect.style.display = 'block';
        setTimeout(() => { crashEffect.style.display = 'none'; }, 600);
    }

    function moveRedCar(x, y) {
        if (cars.red) cars.red.setAttribute('transform', `translate(${x},${y})`);
        if (marking) marking.setAttribute('transform', `translate(${x},${y})`);
    }

    /* ------------------ RADIO SELECTION ------------------ */
   radios.forEach(input => {
    input.addEventListener('change', () => {
        if (locked) return;
        locked = true;

        input.checked = true; // ensure the value is sent
        const action = input.dataset.action;

        // Trigger car movement
        if (action === 'back') moveRedCar(0, 70);
        if (action === 'stop') {
            cars.violet.forEach(car => car && car.setAttribute('transform', 'translate(-480,0)'));
            cars.blue.forEach(car => car && car.setAttribute('transform', 'translate(460,0)'));
        }
        if (action === 'go') {
            cars.violet.forEach(car => car && car.setAttribute('transform', 'translate(-300,0)'));
            cars.blue.forEach(car => car && car.setAttribute('transform', 'translate(170,0)'));
            moveRedCar(0, -110);
        }

        const movementDuration = 650;
       setTimeout(() => {
    // 1️⃣ Crash happens AFTER movement
            if (action === 'back') {
                crash([cars.red, cars.yellow]);
                showCrashEffectOn(cars.yellow, 2);
            }

            if (action === 'go') {
                cars.violet.forEach(car => car && car.setAttribute('transform', 'translate(-300,0)'));
                cars.blue.forEach(car => car && car.setAttribute('transform', 'translate(170,0)'));
                moveRedCar(0, -110);
            }

            // 2️⃣ Submit AFTER crash + extra delay
            setTimeout(() => {
                if (action === 'back') {
                    crash([cars.red, cars.yellow]);
                    showCrashEffectOn(cars.yellow, 2);
                }
                if (action === 'go') {
                    crash([cars.red, ...cars.violet, ...cars.blue]);
                    showCrashEffectOn(cars.violet[1], 2);
                }
                form.submit();
            }, 650);

        }, movementDuration);
            });

        });
    });

    
</script>