<x-app-layout>
    <x-slot name="header">
        <div class="v-box flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('All pages') }}
            </h2>
            <div class="flex-grow"></div> <!-- Invisible spacer -->
            <form method="GET" action="{{ route('subpages.search') }}" class="flex items-center">
                <x-text-input class="block mt-1 w-full"
                         type="text"
                         name="search"
                         placeholder="Search subpages..."
                         :value="request('search')" />
                <x-primary-button class="ml-2">
                    {{ __('Search') }}
                </x-primary-button>
                <div class="flex-grow"></div> <!-- Invisible spacer -->
            </form>
            
        </div>
    </x-slot>
   

    <div>
        <div class="py-12">
            @forelse ($subpages as $subpage)
            <div class="py-12 box w-1">
                <h3 class="h">{{ $subpage->name }}</h3>
                <p class="p-1">{{ $subpage->description }}</p>
                <a class="blue-font fira" href="{{ route('subpages.showSubpage', $subpage->slug) }}">View Subpage</a>
            </div>
            @empty
                <div class="p-1">
                    There are no subpages available.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>