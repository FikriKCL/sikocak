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
                'id' => 1,
                'name' => 'Bronze',
                'imageUri' => 'images.jpg',
            ],
            [
                'id' => 2,
                'name' => 'Silver',
                'imageUri' => 'images.jpg',
            ],
            [
                'id' => 3,
                'name' => 'Gold',
                'imageUri' => 'images.jpg',
            ],
            [
                'id' => 4,
                'name' => 'Diamond',
                'imageUri' => 'images.jpg',
            ],
            [
                'id' => 5,
                'name' => 'Quartz',
                'imageUri' => 'images.jpg',
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
