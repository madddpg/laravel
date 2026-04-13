<x-layouts.app>
  <x-slot:heading>
    Checkout Success
  </x-slot:heading>

  <div class="alert alert-success">
    <div class="fw-semibold">Thank you for your order!</div>
    <div>Your order number is: <span class="fw-bold">{{ $orderNumber }}</span></div>
  </div>

  <div class="d-flex gap-2">
    <a href="{{ route('menu') }}" class="btn btn-primary">Back to Menu</a>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Home</a>
  </div>
</x-layouts.app>
