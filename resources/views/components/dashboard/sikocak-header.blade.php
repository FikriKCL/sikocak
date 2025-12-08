 <header>
    <div class="flex items-center gap-10 bg-white px-4 py-2 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <div class="flex items-center gap-10 bg-white px-7 py-2 rounded-full border-4 border-black">
                    <span class="text-4xl font-black text-black">SiKocak</span>
        </div>
                @php
    $progress = $progressPercentage; // 0 - 100

    $radius = 40;
    $stroke = 8;
    $border = 2;

    $circumference = 2 * pi() * $radius;
    $offset = $circumference * (1 - $progress / 100);
@endphp

<div class="relative w-24 h-24">
    <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">

        <!-- 🔲 OUTER BORDER -->
        <circle
            cx="50"
            cy="50"
            r="{{ $radius + $stroke / 2 + $border }}"
            stroke="black"
            stroke-width="{{ $border }}"
            fill="none"
        />

        <!-- 🔲 BACKGROUND BORDER -->
        <circle
            cx="50"
            cy="50"
            r="{{ $radius }}"
            stroke="black"
            stroke-width="{{ $stroke + $border }}"
            fill="none"
        />

        <!-- ⚪ BACKGROUND -->
        <circle
            cx="50"
            cy="50"
            r="{{ $radius }}"
            stroke="#e5e7eb"
            stroke-width="{{ $stroke }}"
            fill="none"
        />

        <!-- 🔲 PROGRESS BORDER -->
        <circle
            cx="50"
            cy="50"
            r="{{ $radius }}"
            stroke="black"
            stroke-width="{{ $stroke + $border }}"
            fill="none"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $offset }}"
        />

        <!-- 🟢 PROGRESS -->
        <circle
            cx="50"
            cy="50"
            r="{{ $radius }}"
            stroke="#84cc16"
            stroke-width="{{ $stroke }}"
            fill="none"
            stroke-linecap="round"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $offset }}"
            class="transition-all duration-500"
        />

    </svg>

    <!-- % TEXT -->
    <div class="absolute inset-0 flex items-center justify-center">
        <span class="text-lg font-black">
            {{ $progressPercentage }}%
        </span>
    </div>
</div>



</header>