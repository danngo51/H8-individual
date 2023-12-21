<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscribed pages') }}
        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @forelse (auth()->user()->subscriptions as $subpage)
                    <div class="p-6">
                        <h3 class="text-xl font-bold">{{ $subpage->name }}</h3>
                        <p class="text-gray-600">{{ $subpage->description }}</p>
                        <a href="{{ route('subpages.show', $subpage->slug) }}">View Subpage</a>

                    </div>
                @empty
                    <div class="p-6">
                        You are not subscribed to any subpages.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>