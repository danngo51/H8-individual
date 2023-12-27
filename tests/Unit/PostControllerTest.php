<?php

namespace Tests\Unit;

use Tests\TestCase; // Extends 'use PHPUnit\Framework\TestCase;' that is why it is not imported here
use App\Models\Subpage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Post;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_a_unique_slug_for_new_post()
    {
        $subpage = Subpage::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $title = "Sample Post";
        Post::factory()->create(['title' => $title, 'subpage_id' => $subpage->id]);
    
        $postData = ['title' => $title, 'content' => 'Sample content'];
        $response = $this->post(route('subpages.posts.store', $subpage->slug), $postData);
    
        $post = Post::latest('id')->first();
        $this->assertNotEquals($title, $post->slug); // Checking that the slug is not the same as the title
        $this->assertTrue(Str::startsWith($post->slug, Str::slug($title))); // Check if the slug starts with the slugified title
    }
}
