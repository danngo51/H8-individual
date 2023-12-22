<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All pages') }}
        </h2>
        <!-- a search bar -->
    </x-slot> 

    <!-- filter this after the search -->
    <div>
        <div class="py-12">
            @forelse (\App\Models\Subpage::all() as $subpage)
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