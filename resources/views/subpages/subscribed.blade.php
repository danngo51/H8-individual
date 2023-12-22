<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscribed pages') }}
        </h2>
    </x-slot> 

    <div>
        <div class="py-12">
            @forelse (auth()->user()->subscriptions as $subpage)
                <div class="py-12 box w-1">
                    <h3 class="h">{{ $subpage->name }}</h3>
                    <p class="p-1">{{ $subpage->description }}</p>
                    <a class="blue-font fira" href="{{ route('subpages.show', $subpage->slug) }}">View Subpage</a>
                </div>
            @empty
                <div class="p-1">
                    You are not subscribed to any subpages.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>