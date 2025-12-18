<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseLevelSeeder extends Seeder
{
    public function run(): void
    {
        // Get skill id (assuming skill with id=1 exists)
        $skillId = 1;

        // Clear existing exercises for this skill
        DB::table('exercise_steps')->whereIn('id_exercise', function($query) use ($skillId) {
            $query->select('id')->from('exercises')->where('id_skill', $skillId);
        })->delete();
        
        DB::table('exercises')->where('id_skill', $skillId)->delete();

        // Level 1: Pattern Recognition
        $exercise1 = DB::table('exercises')->insertGetId([
            'id_skill' => $skillId,
            'question_text' => 'Pilih gambar yang tepat untuk melanjutkan pola',
            'type' => 'Multiple Choice',
            'level_type' => 'pattern',
            'difficulty' => 1,
            'question_image' => '/images/monster.png',
            'options' => json_encode([
                ['id' => 1, 'colors' => ['green', 'white', 'green'], 'label' => 'Pilihan 1'],
                ['id' => 2, 'colors' => ['green', 'green', 'white'], 'label' => 'Pilihan 2'],
                ['id' => 3, 'colors' => ['white', 'white', 'green'], 'label' => 'Pilihan 3'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('exercise_steps')->insert([
            'id_exercise' => $exercise1,
            'step_number' => 1,
            'content' => 'Pola: Hijau, Hijau, Putih, Hijau, Hijau, Putih, ...',
            'answer' => '2',
            'step_options' => json_encode(['pattern' => ['green', 'green', 'white', 'green', 'green', 'white']]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Level 2: Category Classification
        $exercise2 = DB::table('exercises')->insertGetId([
            'id_skill' => $skillId,
            'question_text' => 'Manakah yang TIDAK termasuk buah?',
            'type' => 'Multiple Choice',
            'level_type' => 'category',
            'difficulty' => 2,
            'options' => json_encode([
                ['id' => 1, 'image' => '/images/apple.svg', 'name' => 'Apel', 'category' => 'fruit'],
                ['id' => 2, 'image' => '/images/banana.svg', 'name' => 'Pisang', 'category' => 'fruit'],
                ['id' => 3, 'image' => '/images/sword.svg', 'name' => 'Pedang', 'category' => 'animal'],
                ['id' => 4, 'image' => '/images/orange.svg', 'name' => 'Jeruk', 'category' => 'fruit'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('exercise_steps')->insert([
            'id_exercise' => $exercise2,
            'step_number' => 1,
            'content' => 'Klik item yang berbeda dari yang lain',
            'answer' => '3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Level 3: Conditional Logic
        $exercise3 = DB::table('exercises')->insertGetId([
            'id_skill' => $skillId,
            'question_text' => 'Mobil merah akan kearah depan, tetapi lampu lalulintas sedang berwarna merah, apa yang perlu dilakukan mobil merah?',
            'type' => 'Multiple Choice',
            'level_type' => 'conditional',
            'difficulty' => 3,
            'question_image' => '/images/traffic-light.png',
            'options' => json_encode([
                ['id' => 1, 'text' => 'BERHENTI', 'action' => 'stop'],
                ['id' => 2, 'text' => 'JALAN', 'action' => 'go'],
                ['id' => 3, 'text' => 'MUNDUR', 'action' => 'back'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('exercise_steps')->insert([
            'id_exercise' => $exercise3,
            'step_number' => 1,
            'content' => 'Perhatikan lampu lalu lintas',
            'answer' => '1',
            'step_options' => json_encode(['traffic_light' => 'red']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Level 4: Drag and Drop Code Blocks
        $exercise4 = DB::table('exercises')->insertGetId([
            'id_skill' => $skillId,
            'question_text' => 'Bantu Icak bergerak ke bendera!',
            'type' => 'Short Answer',
            'level_type' => 'drag_drop',
            'difficulty' => 4,
            'options' => json_encode([
                ['id' => 1, 'code' => 'move_forward()', 'label' => 'Maju'],
                ['id' => 2, 'code' => 'turn_left()', 'label' => 'Hadap Kiri'],
                ['id' => 3, 'code' => 'turn_right()', 'label' => 'Hadap Kanan'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

DB::table('exercise_steps')->insert([
    'id_exercise' => $exercise4,
    'step_number' => 1,
    'content' => 'Susun kode yang benar untuk mencapai bendera',
    'answer' => json_encode([
        'move_forward()',
        'turn_right()',
        'move_forward()',
        'move_forward()',
        'turn_left()',
        'move_forward()',
        'move_forward()',
        'turn_left()',
        'move_forward()',
        'move_forward()',
        'turn_right()',
        'move_forward()',
    ]),
    'step_options' => json_encode(['grid_size' => 3, 'start' => 0, 'end' => 2]),
    'created_at' => now(),
    'updated_at' => now(),
]);


        // Level 5: Code Editor
        $exercise5 = DB::table('exercises')->insertGetId([
            'id_skill' => $skillId,
            'question_text' => 'Tulis kode Python untuk menampilkan teks: Hallo namaku Icak!',
            'type' => 'Short Answer',
            'level_type' => 'code_editor',
            'difficulty' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('exercise_steps')->insert([
            'id_exercise' => $exercise5,
            'step_number' => 1,
            'content' => 'Gunakan perintah print() untuk menampilkan teks',
            'answer' => 'print("Hallo namaku Icak!")',
            'step_options' => json_encode(['expected_output' => 'Hallo namaku Icak!']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
