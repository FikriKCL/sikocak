<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'exercises';

    protected $fillable = [
        'id_skill',
        'question_text',
        'type',
        'difficulty',
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'id_skill');
    }

    public function exerciseSteps()
    {
        return $this->hasMany(ExerciseStep::class, 'id_exercise');
    }

    public function attempts()
    {
        return $this->hasManyThrough(
            Attempt::class,
            ExerciseStep::class,
            'id_exercise', // Foreign key on exercise_steps table
            'id_exercise_step', // Foreign key on attempts table
            'id', // Local key on exercises table
            'id' // Local key on exercise_steps table
        );
    }
}
