<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'skills';

    protected $fillable = [
        'id_course',
        'name',
        'description',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'id_skill');
    }

}
