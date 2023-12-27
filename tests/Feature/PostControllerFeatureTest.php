<?php

namespace Tests\Feature;

use Tests\TestCase; // Extends 'use PHPUnit\Framework\TestCase;' that is why it is not imported here
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Subpage;
use App\Models\User;

class PostControllerFeatureTest extends TestCase
{

    use RefreshDatabase;

    public function it_displays_create_post_form()
    {
        $subpage = Subpage::factory()->create();
        $response = $this->get(route('posts.create', $subpage->id));
        $response->assertStatus(200);
        $response->assertViewIs('posts.create');
        $response->assertViewHas('subpage', $subpage);
    }

    public function it_stores_a_post_and_redirects()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();
        $this->actingAs($user);

        $postData = ['title' => 'Test Post', 'content' => 'Test content'];
        $response = $this->post(route('posts.store', $subpage->slug), $postData);

        $response->assertRedirect(route('subpages.showSubpage', $subpage->slug));
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }

    public function it_toggles_like_on_a_post()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();
        $post = Post::factory()->create(['subpage_id' => $subpage->id]);
        $this->actingAs($user);

        $response = $this->post(route('posts.toggleLike', ['slug' => $subpage->slug, 'post_slug' => $post->slug]));
        $response->assertRedirect();
        $this->assertDatabaseHas('likes', ['user_id' => $user->id, 'post_id' => $post->id]);
    }

    public function it_deletes_a_post()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id, 'subpage_id' => $subpage->id]);
        $this->actingAs($user);

        $response = $this->delete(route('posts.destroy', ['slug' => $subpage->slug, 'postSlug' => $post->slug]));
        $response->assertRedirect();
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }


}
