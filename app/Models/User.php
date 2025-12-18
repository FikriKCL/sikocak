<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements MustVerifyEmail
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
        'name',
        'email',
        'username',
        'password',
        // 'last_streak_at',
        // 'phone_number',
        // 'role',
        // 'streak',
        // 'xp',
        // 'imageUrl',
        // 'id_rank',
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
            'last_streak_at' => 'date',

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

    //Ini COMMENT

        public function updateRank()
        {
            $xp = $this->xp;

            if ($xp >= 2000) $newRank = 5;
            elseif ($xp >= 1000) $newRank = 4;
            elseif ($xp >= 500) $newRank = 3;
            elseif ($xp >= 300) $newRank = 2;
            else $newRank = 1;

            if ($this->id_rank !== $newRank) {
                $this->id_rank = $newRank;
                $this->save();
            }
        }
    
        public function streakUpdate(): bool
        {
            $today = Carbon::today();
            $last = $this->last_streak_at;

            if ($last && $last->equalTo($today)) {
                return false; // tidak naik
            }

            if (!$last || !$last->equalTo($today->copy()->subDay())) {
                $this->streak = 1;
            } else {
                $this->streak += 1;
            }

            $this->last_streak_at = $today;
            $this->save();

            return true;
        }


    // Helper method untuk mendapatkan completed lessons
    public function getCompletedLessonsCount()
    {
        return $this->progress()->where('status', 'Done')->count();
    }

    public function sendEmailVerificationNotification()
    {
        
        $notification = new class extends VerifyEmail implements \Illuminate\Contracts\Queue\ShouldQueue 
        {
            use \Illuminate\Bus\Queueable;
        };

        $notification->afterCommit();

        $this->notify($notification);
    }
}

