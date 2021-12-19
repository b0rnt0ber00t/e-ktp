@include('dashboard.layouts.header')
@include('dashboard.layouts.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
@include('dashboard.layouts.topbar')
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-md-3">
              <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
            </div>
            <div class="col text-right justify-content-md-end">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
          @yield('content-header')
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      @yield('content-body')
    </div>
@include('dashboard.layouts.footer')