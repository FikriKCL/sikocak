<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'uuid' => '1fa3685b-920c-3172-a436-be115a09f272',
                'username' => "admin_ganteng",
                'email' => 'admin@example.com',
                'phone_number' => '089655399710',
                'xp' => 2000,
                'id_rank' => 5,
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'fikri',
                'uuid' => '1fa3685b-920c-3172-a436-be115a09f271',
                'username' => "alfathir",
                'email' => 'alfathir@upi.edu',
                'phone_number' => '089655399710',
                'xp' => 2001,
                'id_rank' => 5,
                'password' => Hash::make('admin123'),
                'role' => 'admin',
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
