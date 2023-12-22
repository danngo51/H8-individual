<x-app-layout>
    <div class="container">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot> 

        @php
            // Collect all posts from subscribed subpages
            $posts = collect();
            foreach (auth()->user()->subscriptions as $subpage) {
                $posts = $posts->merge($subpage->posts);
            }

            // Order by newest first
            $posts = $posts->sortByDesc('created_at');
        @endphp

        <div class="py-12">
            @forelse ($posts as $post)
                <x-blog-template
                    :profileName="$post->user->name"
                    :title="$post->title"
                    :content="$post->content"
                    :createdAt="$post->created_at"
                    :post="$post"
                    :subpageName="$post->subpage->name"
                    :showSubpageName="true"
                    :subpage_slug="$subpage->slug"
                    :post_slug="$post->slug"
                >
                </x-blog-template>
            @empty
                <div class="no-post">
                    <p>You have not subscribed to any subpages or there are no posts yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

