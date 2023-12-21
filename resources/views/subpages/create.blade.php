<x-app-layout>
    <div class="container">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create a new subpage') }}
            </h2>
        </x-slot> 
        <form action="{{ route('subpages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Subpage Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Subpage</button>
        </form>
    </div>
</x-app-layout>