<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="box w-1">
            <h2 class="h">Create a New Blog Post</h2>
            <div class="box">
                <div class="form-title">
                    <img><i class="fas fa-user-circle"></i></img>
                    <input class="content" type="text" id="title" name="title" placeholder="Title">
                </div>
                <div class="content-text">
                    <textarea class="content" id="content" name="content" placeholder="What grinds your gears today...?" rows="6" required></textarea>
                    <button class="ms-3" id="homepage-post-blog-button"> Post </button>
                </div>
            </div>
        </div> 
    </div>
</x-app-layout>
