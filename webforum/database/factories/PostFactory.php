<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Thread;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>$this->faker->name(), 
            'text' =>$this->faker->paragraph(),
            'dateOfCreation' =>now(),
            'numberOfLikes' =>numberBetween($min = 100, $max = 1000),
            'numberOfDislikes' =>numberBetween($min = 100, $max = 1000),
            'user_id' =>User::factory(), 
            'thread_id' =>Thread::factory(), 
            'status' =>$this->faker->randomElement($array= array('Posted','Saved as draft')),
        ];
    }
}
