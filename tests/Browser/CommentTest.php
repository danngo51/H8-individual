<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use \App\Models\User;
use \App\Models\Post;
use \App\Models\Subpage;

class CommentTest extends DuskTestCase
{
    
    use DatabaseMigrations;
    public function testCommentOnPost()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();
        $post = Post::factory()->create(['subpage_id' => $subpage->id]);

        $this->browse(function (Browser $browser) use ($user, $subpage) {
            $browser->loginAs($user)
                ->visit(route('subpages.showSubpage', ['slug' => $subpage->slug]))
                ->screenshot('/comment/1-before-comment-press')
                ->press("COMMENT")
                ->screenshot('/comment/2-after-comment-press')
                ->type('commentContent', 'Test Comment Content')
                ->press("POST COMMENT")
                ->screenshot('/comment/3-after-post-comment-press')
                ->press("COMMENT")
                ->screenshot('/comment/4-after-comment-press2')
                ->assertSee('Test Comment Content');

        });
    }
    
    
}
