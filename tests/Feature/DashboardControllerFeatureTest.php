<?php

namespace Tests\Feature;

use Tests\TestCase; // Extends 'use PHPUnit\Framework\TestCase;' that is why it is not imported here
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Subpage;
use App\Models\User;
use App\Models\Post;

class DashboardControllerFeatureTest extends TestCase
{
    use RefreshDatabase;
    public function test_dashboard_displays_posts_from_subscribed_subpages()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();
        $subpage->subscribers()->attach($user->id);
        $post = Post::factory()->create(['subpage_id' => $subpage->id]);

        $this->actingAs($user);

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHas('posts', function ($posts) use ($post) {
            return $posts->contains($post);
        });
    }

}
