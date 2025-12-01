<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ExerciseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/lesson/{lesson}/start', [DashboardController::class, 'startLesson'])->name('lesson.start');

    Route::get('/lesson/{lesson}', [LessonController::class, 'show'])->name('lesson.show');
    Route::post('/lesson/{lesson}/complete', [LessonController::class, 'complete'])->name('lesson.complete');

        // Exercises
    Route::get('/exercise/{exercise}', [ExerciseController::class, 'show'])->name('exercise.show');
    Route::post('/exercise/{exercise}/submit', [ExerciseController::class, 'submit'])->name('exercise.submit');

    Route::get('/leaderboard', [LeaderboardController::class, 'index']);
   
    });




require __DIR__.'/auth.php';
