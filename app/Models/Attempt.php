<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'score',
        'is_correct',
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'id_user');
    }

}
