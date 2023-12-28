<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\CommentController;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Mockery;


class CommentControllerTest extends TestCase
{
    public function it_toggles_a_like_on_a_comment()
    {
        $user = User::factory()->make();
        $comment = Mockery::mock(Comment::class);
        $comment->shouldReceive('isLikedByUser')->once()->with($user)->andReturn(false);
        $comment->shouldReceive('likes')->once()->andReturnSelf();
        $comment->shouldReceive('attach')->once()->with($user->id);

        // Mock the Auth facade to return the user's ID
        Auth::shouldReceive('id')->once()->andReturn($user->id);
        Auth::shouldReceive('user')->once()->andReturn($user);

        // Call the method
        $response = (new CommentController())->toggleLike($comment);

        // Assertions
        $this->assertNotNull($response);
    
    }
}
