<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_exercise',
        'step_number',
        'content',
        'answer',
    ];

    public function skill()
    {
        return $this->belongsTo(Exercise::class, 'id_exercise');
    }

}
