<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ URL::to('/') }}" class="nav-link px-2 {{ $_SERVER['REQUEST_URI'] == '/' ? 'text-secondary' : 'text-white' }}">Home</a></li>
        @auth
          @php
            $userRole = \Session::get('user_role');
          @endphp
          @if($userRole == 1)
          <li><a href="{{ URL::to('/my-applications') }}" class="nav-link px-2 {{ $_SERVER['REQUEST_URI'] == '/my-applications' ? 'text-secondary' : 'text-white' }}">My Applications</a></li>
          <li><a href="{{ URL::to('/submit-application') }}" class="nav-link px-2 {{ $_SERVER['REQUEST_URI'] == '/submit-application' ? 'text-secondary' : 'text-white' }}">Submit Application</a></li>
          @elseif($userRole == 2)
          <li><a href="{{ URL::to('/applicants-list') }}" class="nav-link px-2 {{ $_SERVER['REQUEST_URI'] == '/applicants-list' ? 'text-secondary' : 'text-white' }}">Applicants List</a></li>
          @endif
        @endauth
      </ul>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
      </form>

      @auth
        <div class="text-end">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
        </div>
      @endguest
    </div>
  </div>
</header>