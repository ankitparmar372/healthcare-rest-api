<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => "patient",
                'email' =>  "patient@gmail.com",
                'password' => bcrypt('123456'),
                'specialty' => NULL,
                'role' => "user",
            ],
            [
                'name' => "doctor",
                'email' =>  "doctor@gmail.com",
                'password' => bcrypt('123456'),
                'specialty' => "Orthopedics",
                'role' => "doctor",
            ]
        ];
        DB::table('users')->insert($users);
    }
}
