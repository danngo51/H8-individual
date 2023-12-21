<x-app-layout>
    <div class="py-12 box w-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create a new subpage') }}
            </h2>
        </x-slot> 


        <form action="{{ route('subpages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <h1 class="h" for="name">Subpage Name</h1>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Subpage Name" required autofocus />
            </div>

            <div class="form-group">
                <h1 class="p-1" for="description">Description (optional)</h1>
                <x-textarea-input id="description" class="block mt-1 w-full" name="description" placeholder="Subpage description: " rows="6" required>
                </x-textarea-input>
            </div>

            <x-primary-button class="ms-3" type="submit">
                {{ __('Create subpage') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>