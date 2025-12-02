<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rank extends Model
{
        /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

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

    public function gradient()
    {
        return match(strtolower($this->name)) {
            'bronze' => 'linear-gradient(to right, #B6511B, #FF9258, #C45013, #45220F)',
            'silver' => 'linear-gradient(to right, #5B5B5B,#6D6D6D,#C1C1C1)',
            'gold'   => 'linear-gradient(to right, #796120,#AF8C2E,#DFB33B)',
            'diamond' => 'linear-gradient(to right, #206179,#3BB3DF,#87DFFF)',
            'quartz' => 'linear-gradient(to right, #792064, #ff58ee, #df3b99)',
            default  => 'linear-gradient(to right, #792064, #ff58ee, #df3b99)',
        };
    }

        public function badge()
    {
        return match($this->id) {
            1 => '/images/bronze.png',
            2 => '/images/silver.png',
            3 => '/images/gold.png',
            4 => '/images/diamond.png',
            5 => '/images/kuarsa.png',
            default => '/images/default.png',
        };
    }
}
