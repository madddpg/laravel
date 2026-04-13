<x-layouts.app>
  <x-slot:heading>
    Menu
  </x-slot:heading>

  <div class="d-flex justify-content-end mb-3 gap-2">
    <a href="{{ route('cart') }}" class="btn btn-outline-primary">View Cart</a>
    <form method="POST" action="{{ route('logout') }}" class="m-0">
      @csrf
      <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if (empty($products))
    <div class="alert alert-warning">No menu items found. Please check public/data/menu.json.</div>
  @else
    <div class="row g-3">
      @foreach ($products as $product)
        <div class="col-12 col-md-4">
          <div class="card h-100 shadow-sm">
            <img
              src="{{ asset('assets/images/' . $product['image']) }}"
              class="card-img-top"
              alt="{{ $product['name'] }}"
              style="object-fit: cover; height: 200px;"
            >
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $product['name'] }}</h5>
              <p class="card-text text-muted">{{ $product['description'] }}</p>
              <div class="mt-auto">
                <div class="fw-semibold mb-2">Price: ₱{{ number_format($product['price'], 2) }}</div>
                <form method="POST" action="{{ route('cart.add', $product['id']) }}">
                  @csrf
                  <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</x-layouts.app>
