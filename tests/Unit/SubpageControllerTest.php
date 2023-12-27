<?php

namespace Tests\Unit;

use Tests\TestCase; // Extends 'use PHPUnit\Framework\TestCase;' that is why it is not imported here
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Subpage;
use Illuminate\Support\Str;

class SubpageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreMethod()
    {
        // Create a user for authentication
        $user = User::factory()->create();

        // Acting as the authenticated user
        $this->actingAs($user);

        // Define subpage data
        $subpageData = [
            'name' => 'Test Subpage',
            'description' => 'This is a test subpage.',
        ];

        // Post request to store method
        $response = $this->post('/subpages', $subpageData);

        // Assert that the subpage was created successfully
        $response->assertStatus(302); // Redirect response
        $this->assertDatabaseHas('subpages', [
            'name' => 'Test Subpage',
            'description' => 'This is a test subpage.',
            'owner_id' => $user->id,
            'slug' => Str::slug('Test Subpage'),
        ]);

        // Assert that the user is subscribed to the subpage
        $this->assertTrue($user->subscriptions()->where('name', 'Test Subpage')->exists());
    }
}
