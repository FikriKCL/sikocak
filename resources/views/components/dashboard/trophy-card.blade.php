@props(['totalScore', 'header'])

<div style="background-color: {{ $header }}" class="rounded-3xl border-4 border-black px-8 py-4 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex items-center gap-4">
    <div class="w-12 h-12 bg-white rounded-full border-3 border-black flex items-center justify-center">
        <svg class="w-8 h-8 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
    </div>
    <span class="text-3xl font-black text-black">{{ $totalScore }}</span>
</div>
