@extends('dashboard.app')

@section('title', 'Dashboard')

@section('content-header')
<div class="row">
  <div class="col-xl-3 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Registered user</h5>
            <span class="h2 font-weight-bold mb-0">{{ $registeredUser }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
              <i class="ni ni-circle-08"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-nowrap mr-2">{{ $registeredUserLastMonth }}</span>
          <span class="text-nowrap">User last month</span>
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Request E-KTP</h5>
            <span class="h2 font-weight-bold mb-0">{{ $requestEktp }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
              <i class="ni ni-chart-pie-35"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-nowrap mr-2">{{ $requestEktpLastMonth }}</span>
          <span class="text-nowrap">Request last month</span>
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Not validated</h5>
            <span class="h2 font-weight-bold mb-0">{{ $requestNotValidated }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
              <i class="ni ni-single-copy-04"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-nowrap mr-2"> 38</span>
          <span class="text-nowrap">Request last month</span>
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Validated</h5>
            <span class="h2 font-weight-bold mb-0">{{ $requestValidated }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
              <i class="ni ni-folder-17"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-nowrap mr-2"> 38</span>
          <span class="text-nowrap">Validated last month</span>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content-body')
<div class="row">
  <div class="col">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Request E-KTP</h3>
      </div>
      <!-- Light table -->
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="name">Name</th>
              <th scope="col" class="sort" data-sort="status">Status</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach($dataEktpRegister as $RequestEktp)
              <tr>
                <th scope="row">
                  <div class="media align-items-center">
                    <a href="#" class="avatar rounded-circle mr-3">
                      <img alt="Image placeholder" src="{{ asset('assets/img/user/profile/' . $RequestEktp->user->image) }}">
                    </a>
                    <div class="media-body">
                      <span class="name mb-0 text-sm">{{ $RequestEktp->user->name }}</span>
                    </div>
                  </div>
                </th>
                <td>
                  <span class="badge badge-dot mr-4">
                    @if($RequestEktp->status == 'approve')
                      <i class="bg-success"></i>
                    @elseif($RequestEktp->status == 'decline')
                      <i class="bg-warning"></i>
                    @else
                      <i class="bg-info"></i>
                    @endif
                      <span class="status">{{ $RequestEktp->status }}</span>
                  </span>
                </td>
                <td class="text-center">
                  <a href="{{ route('user.show', $RequestEktp->user->id) }}" class="badge badge-pill badge-primary">Detail</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection