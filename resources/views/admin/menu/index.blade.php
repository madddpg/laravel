<x-layouts.app>
    <x-slot:heading>
        Manage Menu
    </x-slot:heading>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Menu List</h2>
            <div>
                <a href="{{ route('admin.menu.create') }}" class="btn btn-success">Add New Menu</a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary ml-2">Back to Dashboard</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                    <tr>
                        <td>{{ $menu['id'] }}</td>
                        <td>
                            @if(isset($menu['image']))
                                <img src="{{ asset('assets/images/' . $menu['image']) }}" alt="{{ $menu['name'] }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $menu['name'] }}</td>
                        <td>{{ $menu['description'] }}</td>
                        <td>₱{{ number_format($menu['price'] ?? 0, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.menu.edit', $menu['id']) }}" class="btn btn-sm btn-primary">Edit</a>
                            
                            <form action="{{ route('admin.menu.destroy', $menu['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No menu items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
