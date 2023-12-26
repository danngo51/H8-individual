<x-app-layout>
    <div>
        {{-- ... header and other content ... test --}}

        <div class="py-12">
            @forelse ($posts as $post)
                <x-blog-template
                    :profileName="$post->user->name"
                    :title="$post->title"
                    :content="$post->content"
                    :createdAt="$post->created_at"
                    :post="$post"
                    :subpageName="$post->subpage->name"
                    :showSubpageName="true" {{-- Toggles subpagename to show --}}
                    :subpage_slug="$post->subpage->slug" {{-- Correct subpage slug for each post --}}
                    :post_slug="$post->slug"
                >
                </x-blog-template>
            @empty
                <div class="p-1">
                    <p>It seems you don't have any posts. Subscribe to a page and start H8'ing</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>