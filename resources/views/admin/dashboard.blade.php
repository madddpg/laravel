<x-layouts.app>
    <x-slot:heading>
        Admin Dashboard
    </x-slot:heading>

    <div class="container mt-5">
        <h1>Welcome, {{ auth()->guard('admin')->user()->username ?? 'Admin' }}!</h1>
        <p>This is the admin side. Only authorized administrators can see this content.</p>

        <div class="d-flex gap-3 mb-4">
            <a href="{{ route('admin.menu.index') }}" class="btn btn-primary">Manage Menu</a>
            <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary">Activity Logs</a>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Admin Logout</button>
        </form>
    </div>
</x-layouts.app>