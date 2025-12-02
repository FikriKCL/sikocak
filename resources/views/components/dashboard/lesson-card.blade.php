   <div class="bg-white rounded-3xl border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h2 class="text-2xl font-black mb-4 text-center border-b-4 border-black pb-3">Materi</h2>
                    <div class="space-y-3">
                        @forelse($lessons->take(4) as $index => $lesson)
                        <a 
                            href="{{ route('lesson.show', $lesson->id) }}"
                            class="block w-full bg-[#CCFF00] hover:bg-[#B8E600] px-6 py-4 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                        >
                            <span class="text-xl font-black text-black">{{ $lesson->name }}</span>
                        </a>
                        @empty
                        <p class="text-center text-gray-500">Belum ada materi tersedia</p>
                        @endforelse
                    </div>
                </div>