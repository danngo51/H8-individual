@props(['profileName' => 'Default Name', 'content', 'createdAt'])


<div class="c">
    <div class="c-1">
        <strong class="c-profile c-2">{{ $profileName}}</strong>
        <p class="c-content c-2">{{ $content }}</p>
        <span class="c-span c-2">{{ $createdAt }}</span>
    </div>
    <div class="b-2">
        <x-secondary-button class="button-space" type="submit">
            {{__('Like') }}
        </x-secondary-button>
        <x-secondary-button class="button-space" type="submit">
            {{__('Comment') }}
        </x-secondary-button>
    </div>
</div>