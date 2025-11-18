<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rank extends Model
{
        /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = 'ranks';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'id_user',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
