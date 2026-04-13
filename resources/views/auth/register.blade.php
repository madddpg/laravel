<x-layouts.app>
  <x-slot:heading>
    Register
  </x-slot:heading>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Register</div>
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

            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required autofocus>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password (min 8 characters)</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <div class="mt-3">
              Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>