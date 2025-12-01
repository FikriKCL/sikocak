<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attempt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attempts';

    protected $fillable = [
        'id_user',
        'score',
        'is_correct',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function attemptSteps()
    {
        return $this->hasMany(AttemptStep::class, 'id_attempt');
    }
}