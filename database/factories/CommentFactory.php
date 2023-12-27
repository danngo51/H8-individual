<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;


class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'post_id' => Post::factory(), // Creates a Post for each Comment
            'user_id' => User::factory(), // Creates a User for each Comment
            'content' => $this->faker->paragraph, // Generates a random paragraph
        ];
    }
}

