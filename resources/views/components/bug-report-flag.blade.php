<div>
    <a href="{{ route('bug-report') }}" class="w-16 h-16 bg-white mr-3 shadow-bottomSm rounded-xl border-2 border-black flex items-center gap-2 px-4">

    <!-- Icon -->
   <img
    src="images/flag-bug-report.webp"
    {{ $attributes->merge(['class' => 'w-6 h-6']) }}
    alt="Bug Report"
/>
</a>
</div>