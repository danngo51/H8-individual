<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use \App\Models\User;

class SubpageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    use DatabaseMigrations;

    public function testShowDashboard()
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user) // Log in with the created user
                ->visit(route('dashboard'))
                ->assertSee("It seems you don't have any posts. Subscribe to a page and start H8'ing");
        });
    }
    public function testShowCreateFormSubpage()
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user) // Log in with the created user
                ->visit(route('subpages.create'))
                ->assertSee('Subpage Name')
                ->assertSee('Description (optional)');
        });
    }

    public function testShowSubscribed()
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user) // Log in with the created user
                ->visit(route('subpages.subscribed'))
                ->assertSee('You are not subscribed to any subpages.');
        });
    }

    public function testShowSearch()
    {
        $user = User::factory()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user) // Log in with the created user
                ->visit(route('subpages.search'))
                ->assertSee('There are no subpages available.');
        });
    }

    public function testCreateSubpage()
    {
        // Create a user
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            // Login as the user
            $browser->loginAs($user)
                ->visit(route('subpages.create'))
                ->type('name', 'Test Subpage') 
                ->type('description', 'This is a test subpage') 
                ->screenshot('/subpage/before-create')
                ->press('CREATE SUBPAGE')
                ->screenshot('/subpage/after-create')
                ->assertSee('Test Subpage')
                ->assertSee('No posts yet.'); 
        });
    }
    
   


}
