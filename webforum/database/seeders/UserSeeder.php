<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>"Administrator of the webforum",
            'email'=>"admin@gmail.com",
            'password' =>  "admin",
            'isAdmin' => true,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name'=>"Momcilo Soskic",
            'email'=>"sole@gmail.com",
            'password' =>  "sole123",
            'isModerator' => true,
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'name'=>"Dajana Djokic",
            'email'=>"daki@gmail.com",
            'password' =>  "daki123",
            'isModerator' => true,
            'remember_token' => Str::random(10),
        ]);

        User::factory()->times(5)->create();
    }
}
