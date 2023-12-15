@props(['profileName' => 'Default Name', 'title', 'content', 'createdAt', 'postId'])



<div class="box w-1">
    <div class="titles">
        <h2 class="h">{{ $title }}</h2>
        <span class="p-1">{{ $createdAt->diffForHumans() }}</span>
    </div>
    <div class="b-1">
        <h3 class="h-1">{{ $profileName }}</h3>
        <p class="p-1">{{ $content }}</p>
    </div>
    <div class="b-2">
        <x-secondary-button class="button-space" type="submit">
            {{__('Like') }}
        </x-secondary-button>

        <x-secondary-button class="button-space" type="submit" onclick="toggleCommentSection({{ $postId }})">
            {{__('Comment') }}
        </x-secondary-button>

        <x-secondary-button class="button-space" type="submit">
            {{__('Share') }}
        </x-secondary-button>
    </div>
    <!-- Hidden Comment Section -->
    <div id="comment-section-{{ $postId }}" class="comment-section" style="display: none;"">
        <form method="POST" action="{{ route('posts.comments.store', $postId) }}">
            @csrf
            <textarea name="content" class="block mt-1 w-full" rows="3" placeholder="Write a comment..."></textarea>
            <x-primary-button class="ms-3" type="submit">
                {{ __('Post Comment') }}
            </x-primary-button>
        </form>
    </div> 
</div>

