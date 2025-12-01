<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'phone_number',
        'role',
        'streak',
        'xp',
        'imageUrl',
        'id_rank',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
public function rank()
    {
        return $this->belongsTo(Rank::class, 'id_rank');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'id_user');
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'id_user');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'id_user');
    }

    // Helper method untuk mendapatkan total score
    public function getTotalScore()
    {
        return $this->attempts()->sum('score');
    }

    // Helper method untuk mendapatkan completed lessons
    public function getCompletedLessonsCount()
    {
        return $this->progress()->where('status', 'Done')->count();
    }
}

