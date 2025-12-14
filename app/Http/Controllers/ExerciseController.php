<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Exercise;
use App\Models\ExerciseStep;
use App\Models\Attempt;
use App\Models\AttemptStep;
use App\Models\Skill;

class ExerciseController extends Controller
{
    public function show($exerciseId)
    {
        $user = Auth::user();
        $exercise = Exercise::with(['exerciseSteps', 'skill'])->findOrFail($exerciseId);
        
        if (!$exercise->exerciseSteps) {
            return redirect()->route('dashboard')->with('error', 'Data exercise tidak lengkap. Jalankan migration dan seeder terlebih dahulu.');
        }
        
        // Get all exercises ordered by ID
        $allExercises = Exercise::where('id_skill', $exercise->id_skill)
            ->whereNull('deleted_at')
            ->orderBy('id', 'asc')
            ->get();
        
        $exerciseIndex = $allExercises->search(function($item) use ($exerciseId) {
            return $item->id == $exerciseId;
        });
        
        // Check if previous exercise is completed
        if ($exerciseIndex > 0) {
            $previousExercise = $allExercises[$exerciseIndex - 1];
            
            $previousCompleted = DB::table('attempts')
                ->join('attempt_steps', 'attempts.id', '=', 'attempt_steps.id_attempt')
                ->join('exercise_steps', 'attempt_steps.id_exercise_step', '=', 'exercise_steps.id')
                ->where('attempts.id_user', $user->id)
                ->where('exercise_steps.id_exercise', $previousExercise->id)
                ->where('attempts.is_correct', 1)
                ->whereNull('attempts.deleted_at')
                ->exists();
            
            if (!$previousCompleted) {
                return redirect()->route('dashboard')->with('error', 'Selesaikan level sebelumnya terlebih dahulu!');
            }
        }
        
        if ($exercise->options) {
            $exercise->options = json_decode($exercise->options, true);
        }
        
        if ($exercise->exerciseSteps) {
            foreach ($exercise->exerciseSteps as $step) {
                if ($step->step_options) {
                    $step->step_options = json_decode($step->step_options, true);
                }
            }
        }
        
        $alreadyCompleted = DB::table('attempts')
            ->join('attempt_steps', 'attempts.id', '=', 'attempt_steps.id_attempt')
            ->join('exercise_steps', 'attempt_steps.id_exercise_step', '=', 'exercise_steps.id')
            ->where('attempts.id_user', $user->id)
            ->where('exercise_steps.id_exercise', $exercise->id)
            ->where('attempts.is_correct', 1)
            ->whereNull('attempts.deleted_at')
            ->exists();
        
        $levelType = $exercise->level_type ?? 'show';
        $viewName = 'exercise.' . $levelType;
        
        if (!view()->exists($viewName)) {
            $viewName = 'exercise.show';
        }
        
        return view($viewName, compact('exercise', 'user', 'alreadyCompleted', 'exerciseIndex'));
    }
    
    public function submit(Request $request, $exerciseId)
    {
        $user = Auth::user();
        $exercise = Exercise::with('exerciseSteps')->findOrFail($exerciseId);
        
        if ($exercise->level_type === 'drag_drop') {
            $validated = $request->validate([
                'code_blocks' => 'required|string',
            ]);
        } else {
            $validated = $request->validate([
                'answers' => 'required|array',
                'answers.*' => 'required|string',
            ]);
        }
        

        $score = $user->xp;
        $totalSteps = $exercise->exerciseSteps->count();
        $correctAnswers = 0;
        $errorsDetail = [];
        $userAnswers = [];
        
        $attempt = Attempt::create([
            'id_user' => $user->id,
            'score' => 0,
            'is_correct' => 0,
        ]);
        
        if ($exercise->level_type === 'drag_drop') {
            $exerciseStep = $exercise->exerciseSteps->first();
            $userCodeSequence = $request->input('code_blocks');
            $correctSequence = $exerciseStep->answer;
            
            $isCorrect = $userCodeSequence === $correctSequence;
            
            if ($isCorrect) {
                $correctAnswers++;
                $score += 10;
            } else {
                $errorsDetail[$exerciseStep->id] = true;
            }
            
            $userAnswers[$exerciseStep->id] = $userCodeSequence;
            
            AttemptStep::create([
                'id_attempt' => $attempt->id,
                'id_user' => $user->id,
                'id_exercise_step' => $exerciseStep->id,
                'user_answer' => $userCodeSequence,
                'is_correct' => $isCorrect ? 1 : 0,
            ]);
        } else {
            foreach ($validated['answers'] as $stepId => $userAnswer) {
                $exerciseStep = ExerciseStep::find($stepId);
                
                if ($exerciseStep && $exerciseStep->id_exercise == $exerciseId) {
                    $normalizedUserAnswer = strtolower(trim($userAnswer));
                    $normalizedCorrectAnswer = strtolower(trim($exerciseStep->answer));
                    
                    $isCorrect = $normalizedUserAnswer === $normalizedCorrectAnswer;
                    
                    if ($isCorrect) {
                        $correctAnswers++;
                        $score += 10;
                    } else {
                        $errorsDetail[$stepId] = true;
                    }
                    
                    $userAnswers[$stepId] = $userAnswer;
                    
                    AttemptStep::create([
                        'id_attempt' => $attempt->id,
                        'id_user' => $user->id,
                        'id_exercise_step' => $exerciseStep->id,
                        'user_answer' => $userAnswer,
                        'is_correct' => $isCorrect ? 1 : 0,
                    ]);
                }
            }
        }
        
        $isAllCorrect = $correctAnswers === $totalSteps ? 1 : 0;
        $attempt->update([
            'score' => $score,
            'is_correct' => $isAllCorrect,
        ]);
        
        $user->increment('xp', $score);
        
        //INI COMMENT
        if ($isAllCorrect) {
            $streakIncreased = $user->streakUpdate();

            return redirect()->route('dashboard')->with([
                'popup_title' => 'Sempurna!',
                'popup_message' => $streakIncreased
                    ? '🔥 Streak bertambah!'
                    : 'Latihan selesai hari ini!',
            ]);
        } else {
            return redirect()->route('exercise.show', $exerciseId)
                ->with('error', "Jawaban belum sempurna. Coba lagi!")
                ->with('errors_detail', $errorsDetail)
                ->with('user_answers', $userAnswers);
        }
   
    }
}