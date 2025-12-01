<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
        /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = 'lessons';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'difficulty_level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'id_lesson');
    }

}
