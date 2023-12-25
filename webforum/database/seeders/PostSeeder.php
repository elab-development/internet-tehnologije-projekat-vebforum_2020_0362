<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Post::factory()->create([
                'user_id' => rand(4, 8), // nasumičan broj od 4 do 8
                'thread_id' => rand(1,6), // nasumičan broj od 1 do 6
            ]);
        }
    }
}
