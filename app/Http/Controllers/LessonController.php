<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;
use App\Models\Exercise;
use App\Models\Progress;
use App\Models\Attempt;
use App\Models\AttemptStep;

class LessonController extends Controller
{
    public function show($lessonId)
    {
        $user = Auth::user();
        $lesson = Lesson::with(['course', 'progress'])->findOrFail($lessonId);
        
        // Get exercises untuk skill yang terkait dengan course ini
        $exercises = Exercise::whereHas('skill', function($query) use ($lesson) {
            $query->where('id_course', $lesson->id_course);
        })
        ->with(['exerciseSteps', 'skill'])
        ->where('difficulty', $lesson->difficulty_level)
        ->get();
        
        return view('lesson.show', compact('lesson', 'exercises', 'user'));
    }
    
    public function complete(Request $request, $lessonId)
    {
        $user = Auth::user();
        $lesson = Lesson::findOrFail($lessonId);
        
        // Validate answers
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);
        
        $score = 0;
        $totalQuestions = count($validated['answers']);
        $correctAnswers = 0;
        
        // Create attempt record
        $attempt = Attempt::create([
            'id_user' => $user->id,
            'score' => 0, // Will update later
            'is_correct' => 0,
        ]);
        
        // Check each answer
        foreach ($validated['answers'] as $stepId => $userAnswer) {
            $exerciseStep = \App\Models\ExerciseStep::find($stepId);
            
            if ($exerciseStep) {
                $isCorrect = strtolower(trim($userAnswer)) === strtolower(trim($exerciseStep->answer));
                
                if ($isCorrect) {
                    $correctAnswers++;
                    $score += 10; // 10 points per correct answer
                }
                
                // Save attempt step
                AttemptStep::create([
                    'id_attempt' => $attempt->id,
                    'id_user' => $user->id,
                    'id_exercise_step' => $exerciseStep->id,
                    'user_answer' => $userAnswer,
                    'is_correct' => $isCorrect ? 1 : 0,
                ]);
            }
        }
        
        // Update attempt with final score
        $attempt->update([
            'score' => $score,
            'is_correct' => $correctAnswers === $totalQuestions ? 1 : 0,
        ]);
        
        // Update progress
        $progress = Progress::where('id_user', $user->id)
                           ->where('id_lesson', $lesson->id)
                           ->first();
        
        if ($progress) {
            $progress->update([
                'completed_at' => now(),
                'status' => 'Done',
                'score' => $score,
            ]);
        }
        
        // Update lesson status
        $lesson->update([
            'status' => 'completed',
            'progress' => 100,
        ]);
        
        // Unlock next lesson
        $nextLesson = Lesson::where('id_course', $lesson->id_course)
                           ->where('id', '>', $lesson->id)
                           ->orderBy('id', 'asc')
                           ->first();
        
        if ($nextLesson && $nextLesson->status === 'locked') {
            $nextLesson->update(['status' => 'unlocked']);
        }
        
        // Update user XP
        $user->increment('xp', $score);
        $user->increment('streak');
        
        return redirect()->route('dashboard')->with('success', "Selamat! Anda mendapat $score poin!");
    }
}
