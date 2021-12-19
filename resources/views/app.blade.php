@include('layouts.header')
@include('layouts.topbar')
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Welcome!</h1>
              @yield('content-header-text')
              @guest
                @if (request()->path() == '/')
                  <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-primary my-4">Sign in to continue</a>
                  </div>
                @endif
              @else
                <div class="text-center">
                  <a href="{{ route('dashboard') }}" class="btn btn-primary my-4">Back to dashboard</a>
                </div>
              @endguest
            </div>
          </div>
          <div class="row justify-content-center">
            @if (session()->has('info'))
              <div class="col-md-5 mb--5">
                <div class="alert alert-info">
                  <p class="text-lead text-white">{{ session()->get('info') }}</p>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      @yield('content-body')
    </div>
@include('layouts.footer')