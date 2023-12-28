<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WelcomePageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Welcome to')
                    ->assertSee('H8.IO')
                    ->assertSee('No limitations')
                    ->assertSee('Sign up today and fulfill your inner H8');
        });
    }
}
