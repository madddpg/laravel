<x-layouts.app>
  <x-slot:heading>
    Welcome
  </x-slot:heading>

  <div class="d-flex justify-content-center align-items-center mb-5" style="min-height: 50vh; gap: 1rem;">
    <a href="{{ route('login', ['tab' => 'customer']) }}" class="btn btn-primary btn-lg">Customer</a>
    <a href="{{ route('login', ['tab' => 'admin']) }}" class="btn btn-outline-danger btn-lg">Admin</a>
  </div>
</x-layouts.app>

