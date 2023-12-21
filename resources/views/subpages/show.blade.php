<x-app-layout>
    <div class="container" x-data="{ showCreatePostForm: false }">
        <h1>{{ $subpage->name }}</h1>
        <p>{{ $subpage->description }}</p>
        
        <!-- Subscription Button -->
        @auth
            @if(auth()->user()->isSubscribedTo($subpage))
                <form action="{{ route('unsubscribe', $subpage) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Unsubscribe</button>
                </form>
            @else
                <form action="{{ route('subscribe', $subpage) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            @endif
        @endauth

        <!-- Toggle Button for Create Post Form -->
        @auth
            <button @click="showCreatePostForm = !showCreatePostForm" class="btn btn-secondary">
                <span x-text="showCreatePostForm ? 'Close' : 'Create Post'"></span>
            </button>
        @endauth

        <!-- Collapsible Create Post Form -->
        <div x-show="showCreatePostForm" x-cloak>
            <form method="POST" action="{{ route('subpages.posts.store', $subpage) }}" class="mt-4">
                @csrf
                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required class="form-control">
                </div>
                <div class="mt-4">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="4" required class="form-control"></textarea>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    
        <!-- Posts Section -->
        <div class="posts">
            @forelse ($subpage->posts as $post)
            <x-blog-template
                :profileName="$post->user->name"
                :title="$post->title"
                :content="$post->content"
                :createdAt="$post->created_at"
                :post="$post"
            >
            </x-blog-template>
            @empty
                <p>No posts yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>