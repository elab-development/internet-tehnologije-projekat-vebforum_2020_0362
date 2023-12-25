<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'text' =>$this->faker->paragraph(),
                'dateOfCreation' =>now(),
                'numberOfLikes' =>numberBetween($min = 100, $max = 1000),
                'numberOfDislikes' =>numberBetween($min = 100, $max = 1000),
                'user_id' =>User::factory(), 
                'post_id' =>Post::factory(), 

        ];
    }
}
