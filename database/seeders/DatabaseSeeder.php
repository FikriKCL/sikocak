<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Progress;
use App\Models\Rank;
use App\Models\Exercise;
use App\Models\Course;
use App\Models\ExerciseStep;
use App\Models\AttemptStep;
use App\Models\Attempt;
use App\Models\BugReport;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            userSeeder::class
        ]);
        
        User::factory(10)->create();
        Lesson::factory(5)->create();
        Progress::factory(20)->create(); 
        // Rank::factory(10)->create();
        Attempt::factory(10)->create();
        Course::factory(10)->create();
        Exercise::factory(10)->create();
        ExerciseStep::factory(10)->create();
        AttemptStep::factory(10)->create();
        Attempt::factory(10)->create();
        BugReport::factory(10)->create();

       
    }
}
