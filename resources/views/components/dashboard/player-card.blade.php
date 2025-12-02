@props(['user','header'])
<div class="bg-white rounded-3xl border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <div class="flex flex-col items-center">
                        <!-- Avatar with Rings -->
                        <div class="relative mb-4">
                            {{-- <div class="absolute inset-0 rounded-full border-4 border-[#FF9966] animate-pulse"></div>
                            <div class="absolute inset-[-8px] rounded-full border-4 border-[#FF9966] opacity-60"></div>
                            <div class="absolute inset-[-16px] rounded-full border-4 border-[#FF9966] opacity-30"></div> --}}
                          @if($user->rank && $user->rank->imageUri)
                                    <img src="{{ asset('images/' . $user->rank->imageUri) }}"
                                        alt="{{ $user->rank->name }}"
                                        class="md:w-60 md:h-90 z-10 select-none pointer-events-none"/>
                                @endif

                        </div>

                        <!-- Rank Badge -->
                        <div style="background-color: {{ $header }}" class="px-8 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <span class="text-xl font-black text-white">
                                {{ $user->rank ? $user->rank->name : 'Pemula' }}
                            </span>
                        </div>
                    </div>
     </div>
