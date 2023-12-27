<?php

namespace Tests\Feature;

use Tests\TestCase; // Extends 'use PHPUnit\Framework\TestCase;' that is why it is not imported here
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Subpage;
use App\Models\User;


class SubpageControllerFeatureTest extends TestCase
{

    use RefreshDatabase;

    public function test_show_all_subpages()
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);
        
        // Create some subpages
        Subpage::factory()->count(3)->create();
    
        // Make a GET request to the showAll route
        $response = $this->get(route('subpages.showAll'));
    
        // Assert the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('subpages.subpages');
        $response->assertViewHas('subpages');
        $this->assertCount(3, $response->viewData('subpages'));
    }

    public function test_show_specific_subpage()
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Create a subpage
        $subpage = Subpage::factory()->create();

        // Make a GET request to the showSubpage route
        $response = $this->get(route('subpages.showSubpage', $subpage->slug));

        // Assert the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('subpages.show');
        $response->assertViewHas('subpage', $subpage);
    }

    public function test_subpage_search_functionality()
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);
        
        // Create some subpages
        $subpage1 = Subpage::factory()->create(['name' => 'Test Subpage 1']);
        $subpage2 = Subpage::factory()->create(['name' => 'Another Subpage']);
    
        // Make a GET request to the search route with a search term
        $response = $this->get(route('subpages.search', ['search' => 'Test']));
    
        // Assert the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('subpages.subpages');
        $response->assertSee($subpage1->name);
        $response->assertDontSee($subpage2->name);
    }

}
