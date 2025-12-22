<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Level {{ $exerciseIndex + 1 }} - Coding Maze</title>
@vite(['resources/css/app.css','resources/js/app.js'])

<style>
/* =======================
   TOAST
======================= */
#toast{
    position:fixed; top:1rem; right:1rem;
    min-width:250px; padding:1rem 1.5rem;
    border-radius:.75rem; font-weight:bold;
    color:white; display:none; z-index:9999;
}
#toast.success{background:#4BB543}
#toast.error{background:#FF3333}

/* =======================
   BLOCK HIGHLIGHT ERROR
======================= */
.block-error{
    background:#ffb3b3 !important;
    border-color:#ff0000 !important;
}
</style>

</head>

<body class="bg-[#F5F5F0] min-h-screen">
<div id="toast"></div>

<div class="container mx-auto px-4 py-6">
<header class="flex justify-between items-center mb-6">
    <a href="{{ route('dashboard') }}" class="bg-white px-6 py-3 rounded-full border-4 border-black font-black">← Kembali</a>
    <div class="bg-[#CCFF00] px-6 py-3 rounded-full border-4 border-black font-black">Level {{ $exerciseIndex + 1 }}</div>
    <div class="bg-[#FF9966] px-6 py-3 rounded-full border-4 border-black font-black">{{ $user->xp }} XP</div>
</header>

<form id="mazeForm" method="POST" action="{{ route('exercise.submit',$exercise->id) }}">
@csrf
<input type="hidden" name="code_blocks" id="code_blocks">
<input type="hidden" name="is_finished" id="is_finished">

<div class="grid md:grid-cols-2 gap-6">

<!-- MAP -->

<div class="bg-white p-6 rounded-3xl border-4 border-black">
    <h2 class="text-xl font-black text-center mb-4">{{ $exercise->question_text }}</h2>
    <div id="map" class="relative mx-auto w-[320px] h-[192px] border-4 border-black rounded-xl overflow-hidden">
        <img src="{{ asset('images/map2dd.webp') }}" class="absolute inset-0 w-full h-full">
        <img id="icak" src="{{ asset('images/monster-4.webp') }}" class="absolute w-10 h-10 transition-transform duration-500 my-3">
    </div>
    <p class="text-center font-bold mt-4">Drag & Drop atau Klik Blok</p>
</div>

<!-- BLOCK CODING -->

<div class="bg-white p-6 rounded-3xl border-4 border-black">
    <h3 class="text-xl font-black mb-4">Blok Kode</h3>

<div id="toolbox" class="space-y-2 mb-4">
    @foreach($exercise->options as $cmd)
    <div draggable="true" data-cmd="{{ $cmd['code'] }}"
         class="cmd-block bg-yellow-200 px-4 py-2 rounded-xl border-2 border-black cursor-pointer">
         {{ $cmd['label'] }}
    </div>
    @endforeach
</div>

<h4 class="font-black mb-2">Program Kamu</h4>
<div id="program" class="min-h-[120px] border-2 border-dashed border-black p-3 rounded-xl bg-gray-50"></div>

<button type="submit" class="mt-6 w-full bg-[#CCFF00] px-6 py-4 rounded-full font-black border-4 border-black">
    Jalankan & Kirim
</button>

</div>
</div>
</form>
</div>

<script>
/* =======================
   INIT
======================= */
document.addEventListener('DOMContentLoaded',()=>{

const toast = document.getElementById('toast');
const program = document.getElementById('program');
const icak = document.getElementById('icak');
const form = document.getElementById('mazeForm');
const hidden = document.getElementById('code_blocks');
const finishedInput = document.getElementById('is_finished');

const TILE = 64;
const MAP = [
  [0,0,1,0,2],
  [1,0,1,0,1],
  [1,0,0,0,1],
];

let player = {x:0,y:0,dir:'right'};
let hasFinished=false, stopped=false, errorIndex=null, step=0;

/* =======================
   TOAST
======================= */
function showToast(msg,type='success',t=2500){
    toast.textContent=msg; toast.className=type; toast.style.display='block';
    setTimeout(()=>toast.style.display='none',t);
}

/* =======================
   RENDER + ROTATION
======================= */

function getRotation(dir){
    switch(dir){
        case 'up': return -90;
        case 'right': return 0;
        case 'down': return 90;
        case 'left': return 180;
        default: return 0;
    }
}

function render(){
    icak.style.transform = `
        translate(${player.x * TILE}px, ${player.y * TILE}px)
        rotate(${getRotation(player.dir)}deg)
    `;
}


function nextPos(){
    let {x,y,dir}=player;
    if(dir==='right') x++;
    if(dir==='left') x--;
    if(dir==='up') y--;
    if(dir==='down') y++;
    return {x,y};
}

/* =======================
   MOVE LOGIC
======================= */
function moveForward(){
    const {x,y}=nextPos();
    if(y<0||y>=MAP.length||x<0||x>=MAP[0].length){
        topped=true; errorIndex=step; showToast('🚫 Keluar map','error'); return;
    }
    if(MAP[y][x]===1){
        stopped=true; errorIndex=step; showToast('🧱 Tabrak rintangan','error'); return;
    }
    player.x=x; player.y=y; render();
    if(MAP[y][x]===2) hasFinished=true;
}

function turnLeft(){
    const d = ['up','left','down','right'];
    player.dir = d[(d.indexOf(player.dir)+1) % 4];
    render();
}

function turnRight(){
    const d = ['up','right','down','left'];
    player.dir = d[(d.indexOf(player.dir)+1) % 4];
    render();
}


/* =======================
   DRAG & CLICK ADD
======================= */
document.querySelectorAll('.cmd-block').forEach(b=>{
    b.addEventListener('click',()=>addBlock(b.dataset.cmd));
    b.addEventListener('dragstart',e=>e.dataTransfer.setData('cmd',b.dataset.cmd));
});

program.addEventListener('dragover',e=>e.preventDefault());
program.addEventListener('drop',e=>{
    e.preventDefault(); addBlock(e.dataTransfer.getData('cmd'));
});

function addBlock(cmd){
    if(!cmd) return;
    const el=document.createElement('div');
    el.dataset.cmd=cmd;
    el.className='mb-2 bg-white px-3 py-2 rounded border-2 border-black flex justify-between';
    el.innerHTML=`<span>${cmd}</span><button type="button" onclick="this.parentElement.remove()">×</button>`;
    program.appendChild(el);
}

function resetPlayer(){
    player = { x:0, y:0, dir:'right' };
    render();
}


/* =======================
   RUN PROGRAM
======================= */
async function runProgram(cmds){
 player={x:0,y:0,dir:'right'}; step=0; stopped=false; hasFinished=false; errorIndex=null;
 [...program.children].forEach(b=>b.classList.remove('block-error'));
 render();

 for(const c of cmds){
    if(stopped) break;
    if(c==='move_forward()') moveForward();
    if(c==='turn_left()') turnLeft();
    if(c==='turn_right()') turnRight();
    await new Promise(r=>setTimeout(r,300));
    step++;
 }
 if(errorIndex!==null){
    const b=program.children[errorIndex];
    if(b){b.classList.add('block-error'); b.scrollIntoView({behavior:'smooth',block:'center'});}
 }

 if(!hasFinished){
    setTimeout(() => {
        resetPlayer();
    }, 500);
 }

}

/* =======================
   SUBMIT
======================= */
form.addEventListener('submit',async e=>{
    e.preventDefault();
    const seq=[...program.children].map(b=>b.dataset.cmd);
    hidden.value=JSON.stringify(seq);
    await runProgram(seq);
    if(!hasFinished) return showToast('⚠️ Icak belum sampai tujuan','error');
    finishedInput.value=1;
    form.submit();
});

});
</script>

</body>
</html>