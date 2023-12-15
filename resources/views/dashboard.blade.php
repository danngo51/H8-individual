<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="box w-1">
            <form method="POST" action="{{ route('posts.store') }}">
                @csrf <!-- CSRF token for security -->
                <h2 class="h"> Create a H8 post </h2>
                <div class="form-title">
                    <x-text-input id="post-title" class="block mt-1 w-full" type="text" name="title" placeholder="Title" required autofocus />
                </div>
                <div class="content-text">
                    <x-textarea-input id="post-content" class="block mt-1 w-full" name="content" placeholder="Write your blog post here..." rows="6" required></x-textarea-input>
                    <x-primary-button class="ms-3" type="submit">
                        {{ __('Post') }}
                    </x-primary-button>
                </div>
            </form>
        </div> 
        <!-- Place to show the posts -->
        @foreach ($posts as $post)
            <x-blog-template 
                :profileName="$post->user->name"
                :title="$post->title"
                :content="$post->content"
                :createdAt="$post->created_at"
                :post="$post"
            >
            </x-blog-template>
        @endforeach
    </div>
</x-app-layout>
