<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name' => 'admin',
                'uuid' => '1fa3685b-920c-3172-a436-be115a09f272',
                'email' => 'admin@example.com',
                'phone_number' => '089655399710',
                'id_rank' => 5,
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
