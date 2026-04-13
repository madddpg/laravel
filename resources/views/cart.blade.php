<x-layouts.app>
  <x-slot:heading>
    Cart
  </x-slot:heading>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('menu') }}" class="btn btn-outline-secondary">Back to Menu</a>
    <span class="text-muted">Session-based cart (no database)</span>
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if (empty($cart))
    <div class="alert alert-info">Your cart is empty.</div>
  @else
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>Product</th>
            <th class="text-end">Price</th>
            <th class="text-center">Qty</th>
            <th class="text-end">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cart as $item)
            <tr>
              <td>{{ $item['name'] }}</td>
              <td class="text-end">₱{{ number_format($item['price'], 2) }}</td>
              <td class="text-center">
                <div class="d-inline-flex align-items-center gap-2">
                  <form method="POST" action="{{ route('cart.decrease', $item['id']) }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                  </form>
                  <span class="fw-semibold" style="min-width: 2ch; display: inline-block;">{{ $item['quantity'] }}</span>
                  <form method="POST" action="{{ route('cart.increase', $item['id']) }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                  </form>
                </div>
              </td>
              <td class="text-end">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" class="text-end">Grand Total</th>
            <th class="text-end">₱{{ number_format($grandTotal, 2) }}</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <form method="POST" action="{{ route('checkout') }}" class="mt-3">
      @csrf
      <button type="submit" class="btn btn-success w-100">Checkout</button>
    </form>
  @endif
</x-layouts.app>
