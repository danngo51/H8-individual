<x-app-layout>
    <div class="container">
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

        <!-- Link to Create a New Post -->
        @auth
            <a href="{{ route('subpages.posts.create', $subpage) }}" class="btn btn-secondary">Create Post</a>
        @endauth


        <!-- show posts from this subpage -->
        <div class="posts">
            @forelse ($subpage->posts as $post)
                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->content }}</p>
                </div>
            @empty
                <p>No posts yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>