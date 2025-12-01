@props(['levels'])

@php
    $gap = 140;
    $leftPos  = 'left-[25px]';
    $rightPos = 'left-[135px]';

    // Hitung tinggi SVG
    $svgHeight = count($levels) * 140 + 80;

    // Buat path commands
    $path = "M 0 0 ";
    for ($i = 0; $i < count($levels); $i++) {
        $y1 = ($i * $gap) + 80;
        $y2 = ($i * $gap) + 160;
        $x  = -90;
        $path .= "C 0 {$y1}, {$x} {$y1}, {$x} {$y2} ";
    }
@endphp

<div class="relative w-[260px]"
     style="height: {{ count($levels) * 140 + 40 }}px;">

    <!-- CURVE WITH DYNAMIC COLOR & ANIMATION -->
    <svg class="absolute left-[120px] top-0 curve-animated"
         width="140"
         height="{{ $svgHeight }}">
        <path id="mainCurve"
              d="{{ $path }}"
              stroke="#bfbfbf"
              stroke-width="14"
              fill="none"
              stroke-linecap="round"
              class="curve-progress" />
    </svg>

    <!-- LEVEL DOTS -->
    @foreach ($levels as $i => $state)
        @php
            $pos = $i % 2 == 0 ? $leftPos : $rightPos;
            $top = 10 + ($i * $gap);

            $color =
                $state === 'current'   ? '#78d64b' :
                ($state === 'finished' ? '#ff9f2e' : '#c5c5c5');
        @endphp

        <div class="absolute {{ $pos }} node smooth cursor-pointer"
            style="
                top:{{ $top }}px;
                width:90px;height:90px;
                background:white;
                border:6px solid {{ $color }};
                border-radius:9999px;
                box-shadow:0 6px 0 #00000022;
                display:flex;align-items:center;justify-content:center;
            ">
            <div style="
                width:38px;height:38px;
                border-radius:12px;
                border:6px solid {{ $color }};
            "></div>
        </div>
    @endforeach
</div>

<!-- PATH PROGRESS + SCROLL ANIMATION SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const path = document.querySelector(".curve-progress");
    const length = path.getTotalLength();

    // Initial style
    path.style.strokeDasharray  = length;
    path.style.strokeDashoffset = length;

    const animateScroll = () => {
        const scrollY = window.scrollY;
        const maxScroll = document.body.scrollHeight - window.innerHeight;

        const progress = scrollY / maxScroll;
        const draw = length * progress;

        path.style.strokeDashoffset = length - draw;

        // dynamic color depending progress
        if (progress < 0.33) path.style.stroke = "#ff9f2e";   // orange
        else if (progress < 0.66) path.style.stroke = "#78d64b"; // green
        else path.style.stroke = "#3fa9f5"; // blue (after late progress)
    };

    window.addEventListener("scroll", animateScroll);
    animateScroll();
});
</script>
