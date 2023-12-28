<?php

namespace Tests\Feature;

use Tests\TestCase; // Extends 'use PHPUnit\Framework\TestCase;' that is why it is not imported here
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Subpage;
use App\Models\User;
use App\Models\Post;

class SubscriptionControllerFeatureTest extends TestCase
{
    
    use RefreshDatabase;
    
    public function test_user_can_subscribe_to_a_subpage()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('subscribe', $subpage->slug));

        $response->assertRedirect();
        $this->assertTrue($user->subscriptions->contains($subpage));
    }

    
    public function test_user_can_unsubscribe_from_a_subpage()
    {
        $user = User::factory()->create();
        $subpage = Subpage::factory()->create();
        $user->subscriptions()->attach($subpage);

        $this->actingAs($user);

        $response = $this->delete(route('unsubscribe', $subpage->slug));

    
        $response->assertRedirect();

    
        $this->assertFalse($user->subscriptions->contains($subpage));
    }


}
