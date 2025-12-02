<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Exercise;
use Illuminate\Support\Facades\Log;
use App\Models\Progress;
use App\Models\Attempt;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Load relasi yang dibutuhkan
        $user->load('rank');
        
        // Ambil course pertama atau course yang sedang aktif
        $course = Course::with(['lessons', 'skills'])->first();
        
        $lessons = Lesson::where('id_course', $course->id)
                        ->orderBy('id', 'asc')
                        ->get();
        
        $exercises = Exercise::where('id_skill', 1)
            ->whereNull('deleted_at')
            ->orderBy('id', 'asc')
            ->get();
        
        foreach ($exercises as $index => $exercise) {
            // Cek apakah ada attempt yang berhasil untuk exercise ini
            $isCompleted = DB::table('attempts')
                ->join('attempt_steps', 'attempts.id', '=', 'attempt_steps.id_attempt')
                ->join('exercise_steps', 'attempt_steps.id_exercise_step', '=', 'exercise_steps.id')
                ->where('attempts.id_user', $user->id)
                ->where('exercise_steps.id_exercise', $exercise->id)
                ->where('attempts.is_correct', 1)
                ->whereNull('attempts.deleted_at')
                ->exists();
            
            // Exercise pertama selalu unlocked
            if ($index === 0) {
                $exercise->status = $isCompleted ? 'completed' : 'unlocked';
            } else {
                // Check apakah exercise sebelumnya sudah completed
                $previousExercise = $exercises[$index - 1];
                $previousCompleted = DB::table('attempts')
                    ->join('attempt_steps', 'attempts.id', '=', 'attempt_steps.id_attempt')
                    ->join('exercise_steps', 'attempt_steps.id_exercise_step', '=', 'exercise_steps.id')
                    ->where('attempts.id_user', $user->id)
                    ->where('exercise_steps.id_exercise', $previousExercise->id)
                    ->where('attempts.is_correct', 1)
                    ->whereNull('attempts.deleted_at')
                    ->exists();
                
                if ($previousCompleted) {
                    $exercise->status = $isCompleted ? 'completed' : 'unlocked';
                } else {
                    $exercise->status = 'locked';
                }
            }
        }
        
        $headerColor= [
            1 => '#FF9966',
            2 => '#ADADAD',
            3 => '#FED158',
            4 => '#58FFF9',
            5 => '#FF58EE'
        ];
        
        $header = $headerColor[$user->id_rank] ?? '#FF9966';

        Log::info("Data user logged in : ", $user->toArray());
        
        // Hitung total score dari attempts
        $totalScore = $user->attempts()->sum('score');
        
        // Hitung completed exercises
        $completedExercises = $exercises->where('status', 'completed')->count();
        
        // Hitung persentase progress untuk badge SiKocak
        $totalExercises = $exercises->count();
        $progressPercentage = $totalExercises > 0 
            ? round(($completedExercises / $totalExercises) * 100) 
            : 0;
        
        // Cari exercise yang sedang aktif (unlocked dan belum completed)
        $currentExercise = $exercises->where('status', 'unlocked')->first();
        
        // Tentukan level saat ini berdasarkan completed exercises
        $currentLevel = $completedExercises + 1;
        
        return view('dashboard.index', compact(
            'user',
            'course',
            'headerColor',
            'header',
            'lessons',
            'exercises',
            'totalScore',
            'completedExercises',
            'progressPercentage',
            'currentExercise',
            'currentLevel'
        ));
    }
}
