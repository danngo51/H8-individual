@props([
    'profileName' => 'Default Name',
    'title', 
    'content', 
    'createdAt', 
    'post', 
    'showSubpageName' => false,
    'subpageName' => null, // Default to null since it might not be always provided.
    'slug' // Add this to accept the subpage slug
])


<div class="box w-1">
    <div class="titles">
        <h2 class="h">{{ $title }}</h2>
        <h3 class="h-1">{{ $subpageName }}</h3> <!-- Subpage name included -->
    </div>
    <div class="b-1">
        <h3 class="h-1">{{ $profileName }}</h3>
        <p class="p-1">{{ $content }}</p>
        <span class="p-2">{{ $createdAt->diffForHumans() }}</span>
    </div>
    
    <div class="b-2">
        <form method="POST" action="{{ route('posts.like.toggle', ['slug' => $post->subpage->slug, 'post' => $post->id]) }}">
            @csrf
            <x-secondary-button type="submit" class="button-space {{ $post->isLikedByUser(Auth::user()) ? 'liked' : 'not-liked' }}">
                {{ $post->likes->count() }} {{ __('Like') }}
            </x-secondary-button>
        </form>

        <x-secondary-button class="button-space" type="button" onclick="toggleCommentSection({{ $post->id }})">
            {{ __('Comment') }}
        </x-secondary-button>

        <x-secondary-button class="button-space" type="button">
            {{ __('Share') }} <!-- Placeholder for share functionality -->
        </x-secondary-button>

        
        @if (auth()->check() && auth()->id() === $post->user_id)
            <!-- Form for deleting a post -->
            <form method="POST" action="{{ route('subpages.posts.destroy', [ 'slug' => $slug, 'postSlug' => $post->slug]) }}" id="delete-form-{{ $post->id }}">
                @csrf
                @method('DELETE')
                <x-secondary-button class="button-space red" type="button" onclick="deletePost(event, 'delete-form-{{ $post->id }}')">
                    {{ __('Delete') }}
                </x-secondary-button>
            </form>
        @endif
        

    </div>
    
    <!-- Hidden Comment Section -->
    <div id="comment-section-{{ $post->id }}" class="comment-section" style="display: none;">
        <form method="POST" action="{{ route('posts.comments.store', ['slug' => $post->subpage->slug, 'post' => $post->id]) }}">
            @csrf
            <x-textarea-input name="content" class="block mt-1 w-full" rows="3" placeholder="Write a comment..."></x-textarea-input>
            <x-primary-button class="ms-3" type="submit">
                {{ __('Post Comment') }}
            </x-primary-button>
        </form>
        @foreach($post->comments as $comment)
        <x-comment-template 
            :profileName='$comment->user->name'
            :content='$comment->content'
            :createdAt='$comment->created_at->diffForHumans()'
            :comment='$comment'
        ></x-comment-template>
        @endforeach
    </div>
</div>

<!-- Form for toggling like -->
<form method="POST" action="{{ route('posts.like.toggle', ['slug' => $post->subpage->slug, 'post' => $post->id]) }}">
    @csrf
    <!-- ... -->
</form>

<!-- Form for deleting a post -->
<form method="POST" action="{{ route('subpages.posts.destroy', ['slug' => $subpage->slug, 'postSlug' => $post->slug]) }}" id="delete-form-{{ $post->id }}">
    @csrf
    @method('DELETE')
    <!-- ... -->
</form>

<!-- Form for adding a comment -->
<form method="POST" action="{{ route('posts.comments.store', ['slug' => $post->subpage->slug, 'post' => $post->id]) }}">
    @csrf
    <!-- ... -->
</form>
