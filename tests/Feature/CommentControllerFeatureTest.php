<?php

namespace Tests\Feature;

use Tests\TestCase; // Extends 'use PHPUnit\Framework\TestCase;' that is why it is not imported here
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Subpage;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentControllerFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_post_a_comment_on_a_post()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();
        $post = Post::factory()->create(['subpage_id' => $subpage->id]);

        $this->actingAs($user);

        $commentData = ['content' => 'This is a comment'];
        $response = $this->post(route('posts.comments.store', ['slug' => $subpage->slug, 'postSlug' => $post->slug]), $commentData);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', ['content' => 'This is a comment']);
    }

    
    public function test_a_user_can_like_a_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $this->actingAs($user);

        
        $response = $this->post(route('comments.like.toggle', $comment->id));
        $response->assertRedirect();
        $this->assertTrue($comment->likes->contains($user->id));

    
    }

    public function test_a_user_can_unlike_a_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $comment->likes()->attach($user->id);

        $this->actingAs($user);

        
        $response = $this->post(route('comments.like.toggle', $comment->id));
        $response->assertRedirect();
        $this->assertFalse($comment->likes->contains($user->id));
    }

    public function test_a_user_can_delete_their_own_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->delete(route('comments.destroy', $comment->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }


}
