<x-layouts.app>
  <x-slot:heading>
   Profile
  </x-slot:heading>

  <div class="container py-5">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-4 text-center mb-4 mb-md-0">
        <img src="{{ asset('assets/images/profile.png') }}" alt="Profile picture" class="img-fluid rounded-circle border border-3 border-primary shadow-sm" style="max-width: 220px;">
      </div>
      <div class="col-md-6">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h2 class="card-title h3 mb-3">Hi, I'm <span class="text-primary">Ahmad Paguta</span></h2>
            <p class="card-text text-muted mb-3">
              Feel free to explore my portfolio to learn more about my skills, projects, and how to get in touch. I'm passionate about web development and always eager to connect with like-minded individuals.
            </p>
            <p class="mb-0">
              <a href="/trabaho" class="btn btn-primary me-2">About Me</a>
              <a href="/projects" class="btn btn-outline-secondary">Contact</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-layouts.app>

