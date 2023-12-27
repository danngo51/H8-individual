<?php

namespace Tests\Unit;

use Tests\TestCase; // Extends 'use PHPUnit\Framework\TestCase;' that is why it is not imported here
use App\Http\Controllers\SubpageController;
use App\Models\Subpage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubpageControllerTest extends TestCase
{
    public function testShowSubpage()
    {
        // Mock a Subpage instance
        $subpage = new Subpage([
            'name' => 'Test Subpage',
            'description' => 'Test description',
            'slug' => 'test-subpage',
        ]);

        // Mock a request with the slug
        $request = new Request(['slug' => 'test-subpage']);

        // Create an instance of SubpageController
        $controller = new SubpageController();

        // Mock the behavior of the Eloquent model's findOrFail method
        $this->expectException(ModelNotFoundException::class);

        // Call the showSubpage method with the mock subpage and request
        $view = $controller->showSubpage($subpage->slug);
    }

    public function testShowAll()
    {
        // Create an instance of SubpageController
        $controller = new SubpageController();

        // Call the showAll method
        $view = $controller->showAll();

        // Assert that the result is a View instance
        $this->assertInstanceOf(View::class, $view);

    }

    public function testSearch()
    {
        // Create an instance of SubpageController
        $controller = new SubpageController();

        // Create a mock request with a search term
        $request = new Request(['search' => 'Test Subpage']);

        // Call the search method with the mock request
        $view = $controller->search($request);

        // Assert that the result is a View instance
        $this->assertInstanceOf(View::class, $view);

        
    }
}
