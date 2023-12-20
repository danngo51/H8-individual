<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- User Information -->
        <div class="box w-1">
            <h3 class="h">{{ $user->name }}</h3>
            <p class="p-1">Posts count: {{ $user->posts->count() }}</p>
            <p class="p-1">Comments count: {{ $user->comments->count() }}</p>
            <p class="p-1">Total H8 points: {{ $user->posts->count() + $user->comments->count() }}
        </div>

       <div> 
        <x-secondary-button class="button-space" type="button" onclick="togglePosts()">
            {{ __('Posts') }}
        </x-secondary-button>        

        <x-secondary-button class="button-space" type="button" onclick="toggleComments()">
            {{ __('Comments') }}
        </x-secondary-button>

        <x-secondary-button class="button-space" type="button" onclick="showLikedPosts()">
            {{__('Likes') }}
        </x-secondary-button>
       </div>

       <div class="w" id="user-posts" style="display: none;">
            @foreach ($posts as $post)
                <x-blog-template 
                    :profileName="$post->user->name"
                    :title="$post->title"
                    :content="$post->content"
                    :createdAt="$post->created_at"
                    :post="$post"
                >
                </x-blog-template>
            @endforeach
        </div>
        <div class="w-1" id="user-comments" style="display: none;">
            @foreach ($comments as $comment)
            <x-comment-template
                :profileName='$comment->user->name'
                :content='$comment->content'
                :createdAt='$comment->created_at->diffForHumans()'
                :comment='$comment' 
            >
            </x-comment-template>
        @endforeach
        </div>

    </div>
</x-app-layout>
