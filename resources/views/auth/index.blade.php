@extends('app')

@section('title', 'Login')

@section('content-header-text')
  <p class="text-lead text-white">Use these awesome forms to login or create new account.</p>
@endsection

@section('content-body')
<div class="row justify-content-center">
  <div class="col-lg-5 col-md-7">
    <div class="card bg-secondary border-0 mb-0">
      <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center mb-5">
          <h2 class="text-muted">Sign in with credentials</h2>
        </div>
        <form role="form" action="{{ route('login.store') }}" method="POST">
          @csrf
          <div class="form-group mb-3">
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
              </div>
              <input class="form-control" placeholder="Email" type="email" name="email">
            </div>
            @error('email')
              <div class="text-xs text-muted">{{ $errors->get('email')[0] }}</div>
            @enderror
          </div>
          <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
              </div>
              <input class="form-control" placeholder="Password" type="password" name="password">
            </div>
            @error('password')
              <div class="text-xs text-muted">{{ $errors->get('password')[0] }}</div>
            @enderror
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary my-4">Sign in</button>
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-6">
        <a href="#" class="text-light"><small>Forgot password?</small></a>
      </div>
      <div class="col-6 text-right">
        <a href="{{ route('register') }}" class="text-light"><small>Create new account</small></a>
      </div>
    </div>
  </div>
</div>
@endsection