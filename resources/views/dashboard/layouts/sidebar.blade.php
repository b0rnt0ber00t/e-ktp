  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
          <!-- <img src="{{ asset('assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="..."> -->
          <span class="text-xl font-weight-bolder text-primary">E-KTP</span>
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link{{ request()->path() == 'dashboard' ? ' active' : '' }}" href="{{ route('dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>

          </ul>
          <!-- End Nav items -->
        </div>
      </div>
    </div>
  </nav>