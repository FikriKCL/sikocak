<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Level {{ $exerciseIndex + 1 }} - Coding Maze</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .cell { width: 64px; height: 64px; }
        .block { cursor: grab; }
    </style>
</head>

<body class="bg-[#F5F5F0] min-h-screen">
<div class="container mx-auto px-4 py-6">

    {{-- HEADER --}}
    <header class="flex justify-between items-center mb-8">
        <a href="{{ route('dashboard') }}" class="bg-white px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0]">
            <span class="text-xl font-black">← Kembali</span>
        </a>

        <div class="bg-[#CCFF00] px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0]">
            <h1 class="text-2xl font-black">Level {{ $exerciseIndex + 1 }}</h1>
        </div>

        <div class="bg-[#FF9966] px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0]">
            <span class="text-xl font-black">{{ $user->xp }} XP</span>
        </div>
    </header>

    {{-- FORM --}}
    <form id="mazeForm" action="{{ route('exercise.submit', $exercise->id) }}" method="POST">
        @csrf
        <input type="hidden" name="code_blocks" id="code_blocks">

        <div class="grid md:grid-cols-2 gap-6">

            {{-- MAZE --}}
            <div class="bg-white p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0]">
                <h2 class="text-2xl font-black text-center mb-4">
                    {{ $exercise->question_text }}
                </h2>

                <div class="flex justify-center gap-2 mb-6" id="maze">
                    @for($i=0; $i<5; $i++)
                        <div class="cell bg-gray-100 border-2 border-black flex items-center justify-center" data-index="{{ $i }}">
                            @if($i === 0)
                                <img id="icak" src="{{ asset('images/monster.png') }}" class="w-10 h-10">
                            @elseif($i === 2)
                                <img src="{{ asset('images/silver.png') }}" class="w-8 h-8">
                            @endif
                        </div>
                    @endfor
                </div>

                <p class="text-center font-bold">Susun kode agar Icak sampai ke bendera</p>
            </div>

            {{-- BLOCK CODING --}}
            <div class="bg-white p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0]">
                <h3 class="text-xl font-black mb-4">Blok Kode Python</h3>

                <div class="space-y-2 mb-4" id="toolbox">
                    @foreach(['move_forward()', 'turn_left()', 'turn_right()'] as $cmd)
                        <div draggable="true"
                             data-cmd="{{ $cmd }}"
                             class="block bg-yellow-200 px-4 py-2 rounded-xl border-2 border-black">
                             {{ $cmd }}
                        </div>
                    @endforeach
                </div>

                <h4 class="font-black mb-2">Program Kamu</h4>
                <div id="program"
                     class="min-h-[120px] border-2 border-dashed border-black p-3 rounded-xl bg-gray-50">
                </div>

                <button type="submit"
                        class="mt-6 w-full bg-[#CCFF00] px-6 py-4 rounded-full font-black border-4 border-black">
                    Jalankan & Kirim
                </button>
            </div>

        </div>
    </form>
</div>

{{-- SCRIPT --}}
<script>
    const program = document.getElementById('program');
    const hiddenInput = document.getElementById('code_blocks');

    document.querySelectorAll('.block').forEach(block => {
        block.addEventListener('dragstart', e => {
            e.dataTransfer.setData('text/plain', block.dataset.cmd);
        });
    });

    program.addEventListener('dragover', e => e.preventDefault());

    program.addEventListener('drop', e => {
        e.preventDefault();
        const cmd = e.dataTransfer.getData('text/plain');
        const el = document.createElement('div');

        el.className = 'mb-2 bg-white px-3 py-2 rounded border-2 border-black flex justify-between';
        el.dataset.cmd = cmd;
        el.innerHTML = `<span>${cmd}</span><button onclick="this.parentElement.remove()">×</button>`;
        program.appendChild(el);
    });

    document.getElementById('mazeForm').addEventListener('submit', () => {
        const sequence = [...program.children].map(b => b.dataset.cmd);
        hiddenInput.value = sequence.join(',');
    });
</script>

</body>
</html>
