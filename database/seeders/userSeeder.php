<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    //INI COMMENT
    public function run(): void
    {

        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    
        $users = [
            [
                'name' => 'admin',
                'username' => "admin_ganteng",
                'email' => 'admin@example.com',
                'phone_number' => '089655399710',
                'xp' => 2000,
                'id_rank' => 5,
                'streak' => 10,
                'last_streak_at' => Carbon::now()->subDays(2),
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Fikri Alfathir',
                'username' => "alfathir",
                'email' => 'alfathir@upi.edu',
                'phone_number' => '089655399710',
                'xp' => 299,
                'streak' => 500,
                'streak' => 500,
                'id_rank' => 1,
                'last_streak_at' => Carbon::yesterday(),
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role' => 'user',
            ]
        ];

        $ranks = [
            [
    
                'name' => 'Bronze',
                'imageUri' => 'bronze.png',
            ],
            [
                'name' => 'Silver',
                'imageUri' => 'silver.png',
            ],
            [
                'name' => 'Gold',
                'imageUri' => 'gold.png',
            ],
            [
                'name' => 'Diamond',
                'imageUri' => 'diamond.png',
            ],
            [
                'name' => 'Quartz',
                'imageUri' => 'kuarsa.png',
            ]
        ];

        
        foreach ($ranks as $rank) {
            Rank::create($rank);
        }

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
