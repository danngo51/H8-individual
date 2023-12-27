<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subpage;
use App\Models\User;
use Illuminate\Support\Str;

class SubpageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Subpage::class;

    public function definition()
    {
        $name = $this->faker->words(3, true); // Generates a random name
        return [
            'name' => $name,
            'description' => $this->faker->paragraph, // Generates a random paragraph
            'owner_id' => User::factory(), // Creates a User for each Subpage
            'slug' => Str::slug($name), // Converts name into a slug
        ];
    }
}
