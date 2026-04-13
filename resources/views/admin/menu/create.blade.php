<x-layouts.app>
    <x-slot:heading>
        Add Menu
    </x-slot:heading>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h2>Create New Menu Item</h2>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Back to Menu</a>
        </div>

        <form action="{{ route('admin.menu.store') }}" method="POST" class="shadow p-4 rounded bg-white w-50 m-auto">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Menu Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="price" class="form-label fw-bold">Price (₱)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                @error('price')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- In a full implementation, you would add a file input here for the menu image -->

            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg">Save Menu Item</button>
            </div>
        </form>
    </div>
</x-layouts.app>