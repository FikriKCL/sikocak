<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_attempt',
        'id_user',
        'id_exercise_step',
        'user_answer',
        'is_correct',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


    public function exerciseSteps()
    {
        return $this->belongsTo(ExerciseStep::class, 'id_exercise_step');
    }

    public function attempt(){
        return $this->belongsTo(Attempt::class, 'id_attempt');
    }
}
