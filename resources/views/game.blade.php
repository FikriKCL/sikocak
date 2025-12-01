<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cania Citta - Belajar Bahasa Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen p-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Left Section -->
            <div class="space-y-6">
                <!-- Header -->
                <div class="flex items-center gap-4 bg-[#FF9966] px-8 py-4 rounded-full border-4 border-black w-fit shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <h1 class="text-2xl font-bold">Cania Citta</h1>
                    <div class="w-12 h-12 bg-white rounded-full border-4 border-black flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>

                <div class="flex gap-6">
                    <!-- Profile Card -->
                    <div class="bg-white p-6 rounded-3xl border-4 border-black w-64 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                        <div class="flex flex-col items-center space-y-4">
                            <!-- Avatar dengan circles -->
                            <div class="relative">
                                <div class="w-40 h-40 rounded-full border-4 border-[#FF9966] bg-gradient-to-br from-[#FF9966] to-[#CC6633] flex items-center justify-center shadow-inner">
                                    <div class="w-32 h-32 rounded-full border-4 border-[#FF9966] bg-gradient-to-br from-[#FF9966] to-[#CC6633] flex items-center justify-center">
                                        <div class="w-24 h-24 rounded-full border-4 border-[#CC6633] bg-gradient-to-br from-[#CC6633] to-[#994d26] flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                                <path d="M2 17l10 5 10-5"></path>
                                                <path d="M2 12l10 5 10-5"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Badge -->
                            <div class="bg-[#CC6633] px-8 py-2 rounded-full border-3 border-[#994d26]">
                                <span class="text-[#FFE4D4] font-bold text-lg">{{ $userData['badge'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Materials Panel -->
                    <div class="bg-white p-4 rounded-3xl border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                        <div class="mb-3 px-4 py-2 bg-white rounded-full border-3 border-black text-center">
                            <span class="font-bold text-lg">Materi</span>
                        </div>
                        <div class="space-y-2">
                            @foreach($materials as $material)
                            <button class="w-full bg-[#CCFF00] hover:bg-[#b8e600] px-6 py-3 rounded-full border-3 border-black font-bold text-lg transition-all hover:translate-x-1 hover:translate-y-1 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)]" onclick="completeMaterial({{ $material['id'] }})">
                                {{ $material['name'] }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Trophy Counter -->
                <div class="bg-[#FF9966] px-6 py-3 rounded-full border-4 border-black w-64 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full border-3 border-black flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L9 9H2l6 5-2 7 6-4 6 4-2-7 6-5h-7z"/>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold" id="trophy-count">{{ $userData['trophies'] }}</span>
                </div>
            </div>

            <!-- Right Section -->
            <div class="space-y-6">
                <!-- SiKocak Badge -->
                <div class="flex items-center justify-end gap-4">
                    <div class="bg-white px-8 py-4 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <span class="font-bold text-xl">SiKocak</span>
                    </div>
                    <div class="w-16 h-16 bg-white rounded-full border-4 border-black flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <span class="font-bold text-lg">{{ $userData['sikocak_percentage'] }}%</span>
                    </div>
                </div>

                <!-- Main Play Area -->
                <div class="relative">
                    <!-- Play Button with Level -->
                    <div class="flex flex-col items-center mb-8">
                        <div class="relative mb-4">
                            <!-- Green Ring -->
                            <div class="w-56 h-56 rounded-full border-8 border-[#CCFF00] bg-white flex items-center justify-center shadow-[6px_6px_0px_0px_rgba(0,0,0,0.2)]">
                                <!-- Play Icon Circle -->
                                <div class="w-40 h-40 rounded-full border-6 border-black bg-white flex items-center justify-center shadow-inner">
                                    <button onclick="startLevel({{ $userData['current_level'] }})" class="hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Mascot -->
                            <div class="absolute -top-4 -right-8 w-20 h-20 bg-[#CCFF00] rounded-t-full border-4 border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] animate-bounce">
                                <div class="absolute top-3 left-1/2 -translate-x-1/2 w-10 h-10 bg-white rounded-full border-3 border-black flex items-center justify-center">
                                    <div class="w-4 h-4 bg-black rounded-full"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Level Badge -->
                        <div class="bg-[#CCFF00] px-10 py-3 rounded-full border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <span class="font-bold text-2xl">Level {{ $userData['current_level'] }}</span>
                        </div>
                    </div>

                    <!-- Level Path -->
                    <div class="flex flex-col items-center space-y-4 pl-12">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="relative">
                            <!-- Connecting Line -->
                            @if($i < 4)
                            <div class="absolute left-1/2 top-full -translate-x-1/2 w-1 h-12 bg-gray-300"></div>
                            @endif
                            
                            <!-- Level Node -->
                            <div class="w-24 h-24 rounded-full border-6 border-gray-300 bg-white flex items-center justify-center shadow-md {{ $i <= count($userData['unlocked_levels']) ? 'opacity-100' : 'opacity-40' }}">
                                <div class="w-12 h-12 bg-gray-200 rounded-lg border-3 border-gray-400"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function startLevel(level) {
            fetch(`/start-level/${level}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Update trophy count
                const currentTrophies = parseInt(document.getElementById('trophy-count').textContent);
                document.getElementById('trophy-count').textContent = currentTrophies + 10;
            })
            .catch(error => console.error('Error:', error));
        }

        function completeMaterial(materialId) {
            fetch(`/complete-material/${materialId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>