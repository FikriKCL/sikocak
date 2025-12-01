<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'description',
        'difficulty_level',
    ];

    // ✅ RELASI YANG HILANG
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'id_course');
    }
    public function skills()
    {
        return $this->hasMany(Skill::class, 'id_course');
    }
}
