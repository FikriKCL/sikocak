<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Materials
        DB::table('materials')->insert([
            ['name' => 'Materi-1', 'description' => 'Pengenalan Bahasa Indonesia', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Materi-1', 'description' => 'Kosakata Dasar', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Materi-1', 'description' => 'Tata Bahasa', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Materi-1', 'description' => 'Latihan Soal', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Levels
        for ($i = 1; $i <= 4; $i++) {
            DB::table('levels')->insert([
                'level_number' => $i,
                'name' => "Level $i",
                'is_locked' => $i > 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
