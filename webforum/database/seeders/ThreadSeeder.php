<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Thread;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 6; $i++) {
            Thread::factory()->create([
                'user_id' => rand(4, 8), // nasumičan broj od 4 do 8
            ]);
        }

        Thread::create([
            'name'=>"Pretraga",
            'description'=>"Ovo je za 1 pretragu.",
            'dateOfCreation' =>  now(),
            'user_id' => 6,
        ]);
        Thread::create([
            'name'=>"Pretraga",
            'description'=>"Ovo je za 2 pretragu.",
            'dateOfCreation' =>  now(),
            'user_id' => 6,
        ]);
        Thread::create([
            'name'=>"Pretraga",
            'description'=>"Ovo je za 3 pretragu.",
            'dateOfCreation' =>  now(),
            'user_id' => 6,
        ]);
    }
}
