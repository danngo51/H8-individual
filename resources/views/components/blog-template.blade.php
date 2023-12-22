@props([
    // every prop is being assigned with the $
    'profileName' => 'Default Name',
    'title', 
    'content', 
    'createdAt', 
    'post', 
    'showSubpageName' => false,
    'subpageName' => null, // Default to null since it might not be always provided.
    'subpage_slug', // Add this to accept the subpage slug
    'post_slug'
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
        <!-- 'slug' is the one in the route and gets its value from '$subpage_slug '. The $subpage_slug value is being transfered from the parrent blade via the props at the top. -->
        <form method="POST" action="{{ route('posts.like.toggle', ['slug' => $subpage_slug, 'post_slug' => $post_slug]) }}"> 
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

        {{--
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
        --}}
        

    </div>
    
    
</div>


