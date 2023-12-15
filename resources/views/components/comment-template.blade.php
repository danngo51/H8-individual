

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
        <x-secondary-button class="button-space" type="submit">
            {{__('Comment') }}
        </x-secondary-button>
    </div>
</div>