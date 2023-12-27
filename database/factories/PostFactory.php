<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use App\Models\Subpage;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Creates a User for each Post
            'subpage_id' => Subpage::factory(), // Creates a Subpage for each Post
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'slug' => function (array $attributes) {
                return Str::slug($attributes['title']);
            },
        ];
    }
}
