<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\BugReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/{username}', [ProfileController::class,'show'])->name('profile.show');
    Route::patch('/profile/patch', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/lesson/{lesson}/start', [DashboardController::class, 'startLesson'])->name('lesson.start');

    Route::get('/lesson/{lesson}', [LessonController::class, 'show'])->name('lesson.show');
    Route::post('/lesson/{lesson}/complete', [LessonController::class, 'complete'])->name('lesson.complete');

        // Exercises
    Route::get('/exercise/{exercise}', [ExerciseController::class, 'show'])->name('exercise.show');
    Route::post('/exercise/{exercise}/submit', [ExerciseController::class, 'submit'])->name('exercise.submit');

    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

    //     // bug report
    // Route::get('/bug-report', function () {
    // return view('auth.bug-report');
    // });

    // Route::post('/bug-report', [BugReportController::class, 'store'])->name('bug-report.store');

    Route::get('/bug-report', function () {
        return view('bug-report');   
    })->name('bug-report');

    Route::post('/bug-report', [BugReportController::class, 'store'])
        ->name('bug-report.store');
    });

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');



require __DIR__.'/auth.php';
