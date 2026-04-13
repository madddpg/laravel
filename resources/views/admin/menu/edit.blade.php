<x-layouts.app>
    <x-slot:heading>
        Edit Menu
    </x-slot:heading>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h2>Edit Menu Item: {{ $menu['name'] }}</h2>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Back to Menu</a>
        </div>

        <form action="{{ route('admin.menu.update', $menu['id']) }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-white w-50 m-auto">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Menu Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $menu['name']) }}" required>
                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $menu['description']) }}</textarea>
                @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="price" class="form-label fw-bold">Price (₱)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $menu['price']) }}" required>
                @error('price')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="image" class="form-label fw-bold">Menu Image</label>
                @if(isset($menu['image']))
                    <div class="mb-2">
                        <img src="{{ asset('assets/images/' . $menu['image']) }}" alt="{{ $menu['name'] }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                    </div>
                @endif
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <small class="text-muted">Leave empty to keep the current image.</small>
                @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Update Menu Item</button>
            </div>
        </form>
    </div>
</x-layouts.app>