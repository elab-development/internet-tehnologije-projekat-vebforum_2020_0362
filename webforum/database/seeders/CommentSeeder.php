<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Comment;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Comment::factory()->create([
                'user_id' => rand(4, 8), // nasumičan broj od 4 do 8
                'post_id' => rand(1,8), // nasumičan broj od 1 do 8
            ]);
        }
    }
}
