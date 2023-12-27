<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PostControllerTest extends TestCase
{
    public function it_generates_a_unique_slug_for_new_post()
    {
        $subpage = Subpage::factory()->create();
        $postTitle = 'New Post Title';
        $expectedSlug = 'new-post-title';
    
        Post::factory()->create(['title' => $postTitle, 'subpage_id' => $subpage->id, 'slug' => $expectedSlug]);
        
        $newSlug = $this->callPrivateMethod($this->postController, 'generateSlug', [$postTitle, $subpage->id]);
        
        $this->assertEquals('new-post-title-1', $newSlug);
    }
}
