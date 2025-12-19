<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Level {{ $exerciseIndex + 1 }} - Coding Maze</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
#toast {
    position: fixed; top: 1rem; right: 1rem;
    min-width: 250px; padding: 1rem 1.5rem;
    border-radius: 0.75rem; font-weight: bold;
    color: white; display: none; z-index: 9999;
}
#toast.success { background-color: #4BB543; }
#toast.error { background-color: #FF3333; }
</style>
</head>
<body class="bg-[#F5F5F0] min-h-screen">
<div id="toast"></div>

<div class="container mx-auto px-4 py-6">
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

<form id="mazeForm" method="POST" action="{{ route('exercise.submit',$exercise->id) }}">
    @csrf
    <input type="hidden" name="code_blocks" id="code_blocks">
    <input type="hidden" name="is_finished" id="is_finished">

    <div class="grid md:grid-cols-2 gap-6">

        <!-- MAP -->
        <div class="bg-white p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0]">
            <h2 class="text-xl font-black text-center mb-4">{{ $exercise->question_text }}</h2>
            <div id="map" class="relative mx-auto w-[320px] h-[192px] border-4 border-black rounded-xl overflow-hidden">
                <img src="{{ asset('images/map2dd.webp') }}" class="absolute inset-0 w-full h-full object-cover" alt="Map">
                <img id="icak" src="{{ asset('images/monster.webp') }}" class="absolute w-10 h-10 transition-transform duration-500">
            </div>
            <p class="text-center font-bold mt-4">Susun kode agar Icak sampai tujuan</p>
            <p class="text-center font-bold mt-4">Cara Main : Drag & Drop</p>
        </div>

        <!-- BLOCK CODING -->
        <div class="bg-white p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0]">
            <h3 class="text-xl font-black mb-4">Blok Kode</h3>
            <div id="toolbox" class="space-y-2 mb-4">
                @foreach($exercise->options as $cmd)
                <div draggable="true" data-cmd="{{ $cmd['code'] }}" 
                     class="block bg-yellow-200 px-4 py-2 rounded-xl border-2 border-black cursor-grab">{{ $cmd['label'] }}</div>
                @endforeach
            </div>

            <h4 class="font-black mb-2">Program Kamu</h4>
            <div id="program" class="min-h-[120px] border-2 border-dashed border-black p-3 rounded-xl bg-gray-50"></div>

            <button type="submit" class="mt-6 w-full bg-[#CCFF00] px-6 py-4 rounded-full font-black border-4 border-black">Jalankan & Kirim</button>
        </div>
    </div>
</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', ()=>{

/* =======================
   TOAST
======================= */
const toast = document.getElementById('toast');
function showToast(msg, type='success', duration=2500){
    toast.textContent = msg;
    toast.className = type;
    toast.style.display = 'block';
    setTimeout(()=>toast.style.display='none', duration);
}

/* =======================
   ELEMENTS & STATE
======================= */
const form = document.getElementById('mazeForm');
const hidden = document.getElementById('code_blocks');
const finishedInput = document.getElementById('is_finished');
const program = document.getElementById('program');
const icak = document.getElementById('icak');

let player = { x:0, y:0, dir:'right' };
let hasFinished = false;
let executionStopped = false;
let currentStepIndex = 0;
let errorIndex = null;

const TILE = 64;
const MAP = [
  [0,0,1,0,2],
  [1,0,1,0,1],
  [1,0,0,0,1],
];

/* =======================
   HELPERS
======================= */
function render(){
    icak.style.transform = `translate(${player.x * TILE}px, ${player.y * TILE}px)`;
}

function nextPos(){
    let nx = player.x, ny = player.y;
    if(player.dir === 'right') nx++;
    if(player.dir === 'left') nx--;
    if(player.dir === 'up') ny--;
    if(player.dir === 'down') ny++;
    return { nx, ny };
}

function clearBlockErrors(){
    [...program.children].forEach(el => el.classList.remove('block-error'));
}

/* =======================
   MOVEMENT LOGIC
======================= */
function moveForward(){
    if(executionStopped) return false;

    const { nx, ny } = nextPos();

    if(ny < 0 || ny >= MAP.length || nx < 0 || nx >= MAP[0].length){
        showToast('🚫 Keluar map', 'error');
        executionStopped = true;
        errorIndex = currentStepIndex;
        return false;
    }

    if(MAP[ny][nx] === 1){
        showToast('🧱 Ada rintangan', 'error');
        executionStopped = true;
        errorIndex = currentStepIndex;
        return false;
    }

    player.x = nx;
    player.y = ny;
    render();

    if(MAP[ny][nx] === 2){
        hasFinished = true;
    }

    return true;
}

function turnLeft(){
    const d = ['up','left','down','right'];
    player.dir = d[(d.indexOf(player.dir)+1) % 4];
}

function turnRight(){
    const d = ['up','right','down','left'];
    player.dir = d[(d.indexOf(player.dir)+1) % 4];
}

/* =======================
   DRAG & DROP
======================= */
document.getElementById('toolbox').addEventListener('dragstart', e=>{
    if(e.target.dataset.cmd){
        e.dataTransfer.setData('text/plain', e.target.dataset.cmd);
    }
});

program.addEventListener('dragover', e=>e.preventDefault());

program.addEventListener('drop', e=>{
    e.preventDefault();
    const cmd = e.dataTransfer.getData('text/plain');
    if(!cmd) return;

    const el = document.createElement('div');
    el.dataset.cmd = cmd;
    el.className = 'mb-2 bg-white px-3 py-2 rounded border-2 border-black flex justify-between';
    el.innerHTML = `<span>${cmd}</span>
        <button type="button" onclick="this.parentElement.remove()">×</button>`;
    program.appendChild(el);
});

/* =======================
   RUN PROGRAM
======================= */
async function runProgram(cmds){
    player = { x:0, y:0, dir:'right' };
    hasFinished = false;
    executionStopped = false;
    currentStepIndex = 0;
    errorIndex = null;

    clearBlockErrors();
    render();

    for(const c of cmds){
        if(executionStopped) break;

        if(c === 'move_forward()') moveForward();
        if(c === 'turn_left()') turnLeft();
        if(c === 'turn_right()') turnRight();

        currentStepIndex++;
        await new Promise(r => setTimeout(r, 300));
    }

    if(errorIndex !== null){
        const block = program.children[errorIndex];
        if(block){
            block.classList.add('block-error');
            block.scrollIntoView({ behavior:'smooth', block:'center' });
        }
    }
}

/* =======================
   SUBMIT
======================= */
form.addEventListener('submit', async e=>{
    e.preventDefault();

    const seq = [...program.children].map(b => b.dataset.cmd);
    hidden.value = JSON.stringify(seq);

    await runProgram(seq);

    if(!hasFinished){
        showToast('⚠️ Icak belum sampai tujuan!', 'error');
        return;
    }

    finishedInput.value = 1;

    const formData = new FormData(form);
    try{
        const res = await fetch(form.action,{
            method:'POST',
            body: formData,
            headers:{
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept':'application/json'
            }
        });

        const data = await res.json();

        if(data.success){
            showToast(data.popup_message || 'Level selesai!', 'success');
            setTimeout(()=>{
                if(data.next_url) window.location.href = data.next_url;
            }, 1000);
        }else{
            showToast(data.error_message || 'Jawaban belum sempurna!', 'error', 4000);
        }
    }catch(err){
        console.error(err);
        setTimeout(()=>form.submit(), 500);
    }
});

});
</script>

</body>
</html>
