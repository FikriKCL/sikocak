<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

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

}
