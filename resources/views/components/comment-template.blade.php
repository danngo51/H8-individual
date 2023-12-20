@props(['profileName' => 'Default Name', 'content', 'createdAt', 'comment'])


<div class="c">
    <div class="c-1">
        <strong class="c-profile c-2">{{ $profileName}}</strong>
        <p class="c-content c-2">{{ $content }}</p>
        <span class="c-span c-2">{{ $createdAt }}</span>
    </div>
    <div class="b-2">
        <form method="POST" action="{{ route('comments.like.toggle', $comment->id) }}">
            @csrf
            <x-secondary-button type="submit" class="button-space {{ $comment->isLikedByUser(Auth::user()) ? 'liked' : 'not-liked' }}">
                {{ $comment->likes->count() }} {{__('Like') }}
            </x-secondary-button>
        </form>

    </div>
</div>