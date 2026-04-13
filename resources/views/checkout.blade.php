<x-layouts.app>
  <x-slot:heading>
    Checkout Success
  </x-slot:heading>

  <div class="alert alert-success">
    <div class="fw-semibold">Checkout completed successfully.</div>
    <div>Order Number: <span class="fw-bold">{{ $orderNumber }}</span></div>
  </div>

  <div class="d-flex gap-2">
    <a href="{{ route('menu') }}" class="btn btn-primary">Back to Menu</a>
    <a href="{{ route('cart') }}" class="btn btn-outline-secondary">View Cart</a>
  </div>
</x-layouts.app>
