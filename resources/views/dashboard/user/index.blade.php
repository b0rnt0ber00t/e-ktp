@extends('dashboard.app')

@section('title', 'Dashboard')

@section('content-header')
<div class="row">
  <div class="col-md-7">
    @if (auth()->user()->requested() == null)
      <div class="alert alert-primary">To register for an E-KTP, <a href="{{ route('user') }}" class="text-white">click here</a></div>
    @else
      <div class="alert alert-primary">Wait some time to verify your request.</a></div>
    @endif
  </div>
</div>
@endsection

@section('content-body')
<div class="row">
  <div class="col-md-7">
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-4 my-auto mx-auto">
          <img src="{{ asset('assets/img/user/profile/' . auth()->user()->image) }}" class="img-fluid rounded-start" alt="{{ auth()->user()->image }}">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h3 class="card-title">{{ auth()->user()->name }}</h3>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            @if($requestEktpStatus != null)
              <p class="card-text">
                <span class="badge badge-dot mr-4">
                  @if($requestEktpStatus->status == 'approve')
                    <i class="bg-success"></i>
                  @elseif($requestEktpStatus->status == 'decline')
                    <i class="bg-warning"></i>
                  @else
                    <i class="bg-info"></i>
                  @endif
                    <span class="status">{{ $requestEktpStatus->status }}</span>
                </span>
              </p>
            @endif
            <p class="card-text"><small class="text-muted">{{ auth()->user()->email }}</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection