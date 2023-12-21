<x-app-layout>
    <div class="container">
        <h1>Create a New Subpage</h1>
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

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</x-app-layout>