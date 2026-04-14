<x-layouts.app>
  <x-slot:heading>
    Welcome
  </x-slot:heading>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white text-center fw-bold fs-5">Select Your Role</div>
          <div class="card-body">
            
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <ul class="nav nav-tabs nav-justified mb-4" id="loginTypeTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link {{ request('tab', 'customer') === 'customer' ? 'active' : '' }} fw-bold" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer" type="button" role="tab" aria-controls="customer" aria-selected="{{ request('tab', 'customer') === 'customer' ? 'true' : 'false' }}">Customer</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link {{ request('tab') === 'admin' ? 'active' : '' }} fw-bold" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="{{ request('tab') === 'admin' ? 'true' : 'false' }}">Admin</button>
              </li>
            </ul>

            <div class="tab-content" id="loginTypeTabsContent">
              <!-- Customer Tab -->
              <div class="tab-pane fade {{ request('tab', 'customer') === 'customer' ? 'show active' : '' }}" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                <p class="text-muted mb-4 text-center">Enter your username to start ordering.</p>
                <form method="POST" action="{{ route('login.customer') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus placeholder="e.g. John Doe">
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Proceed to Menu</button>
                </form>
              </div>

              <!-- Admin Tab -->
              <div class="tab-pane fade {{ request('tab') === 'admin' ? 'show active' : '' }}" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                <p class="text-muted mb-4 text-center">Enter admin password to access dashboard.</p>
                <form method="POST" action="{{ route('login.admin') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="password" class="form-label">Admin Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <button type="submit" class="btn btn-danger w-100">Login as Admin</button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>