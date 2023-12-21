<x-app-layout>
    <div class="container">
        <h1>Dashboard</h1>
        @forelse (auth()->user()->subscriptions as $subpage)
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('subpages.show', $subpage) }}">{{ $subpage->name }}</a>
                </div>
                <div class="card-body">
                    @forelse ($subpage->posts as $post)
                        <article class="mb-4">
                            <h3>{{ $post->title }}</h3>
                            <p>{{ Str::limit($post->content, 150) }}</p>
                            <a href="{{ route('subpages.posts.show', [$subpage, $post]) }}">Read more</a>
                        </article>
                    @empty
                        <p>No posts yet.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <p>You are not subscribed to any subpages.</p>
        @endforelse
    </div>
</x-app-layout>