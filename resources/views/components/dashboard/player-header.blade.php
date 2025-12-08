@props(['user','header'])
<!-- Logo/Brand -->
      <header>
            <div class="flex items-center gap-3 px-6 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]" style="background-color: {{ $header }};">
                <a href="{{ route('profile.show', $user->name)}}" class="text-2xl font-black text-white">{{$user->name}}</a>
                <div class="w-10 h-10 bg-white rounded-full border-3 border-black flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </header>