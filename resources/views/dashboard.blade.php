<x-app-layout>
    <div class="py-12">
        {{-- ... header and other content ... --}}

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
                <div class="no-post">
                    <p>You have not subscribed to any subpages or there are no posts yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>