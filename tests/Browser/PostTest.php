<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use \App\Models\User;
use \App\Models\Post;
use \App\Models\Subpage;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;


    public function testCreatePost()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $subpage) {
            $browser->loginAs($user) // Log in with the created user
                ->visit(route('subpages.showSubpage', ['slug' => $subpage->slug])) 
                ->press('CREATE POST')
                ->type('title', 'Test Post Title') // Fill in the title field
                ->type('content', 'Test Post Content') // Fill in the content field'
                ->screenshot('/post/before-before')
                ->press('POST') // Press the submit button
                ->screenshot('/post/after-post')
                ->assertPathIs("/subpages/{$subpage->slug}")
                ->assertSee('Test Post Title')
                ->assertSee('Test Post Content');
        });
    }

    public function testToggleLike()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();

        $post = Post::factory()->create(['subpage_id' => $subpage->id]);

        $this->browse(function (Browser $browser) use ($user, $subpage) {
            $browser->visit(route('subpages.showSubpage', ['slug' => $subpage->slug]))
                ->screenshot('/like-post/before-like')
                ->press("LIKE")
                ->screenshot('/like-post/after-like');
        });
    }
   
}
