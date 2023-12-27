<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexMethod()
    {
        // Mock the authentication
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some posts for testing
        $posts = Post::factory()->count(3)->create([
            'user_id' => $user->id
        ]);

        // Call the index method
        $response = $this->get('/dashboard');

        // Assertions
        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHas('posts', function ($viewPosts) use ($posts) {
            return count($viewPosts) === 3; // Check if 3 posts are passed to the view
        });
    }
}
