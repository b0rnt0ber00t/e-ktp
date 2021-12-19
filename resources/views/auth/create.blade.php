@extends('app')

@section('title', 'Register')

@section('content-header-text')
  <p class="text-lead text-white">Use these awesome forms to login or create new account.</p>
@endsection

@section('content-body')
<div class="row justify-content-center">
  <div class="col-lg-6 col-md-8">
    <div class="card bg-secondary border-0 mb-0">
      <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
          <small>Sign up with credentials</small>
        </div>
        <form role="form" action="{{ route('register.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
              </div>
              <input class="form-control" placeholder="Name" type="text" name="name">
            </div>
            @error('name')
              <div class="text-xs text-muted">{{ $errors->get('name')[0] }}</div>
            @enderror
          </div>
          <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative mb-3">
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
          <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
              </div>
              <input class="form-control" placeholder="Confirm Password" type="password" name="conf_password">
            </div>
            @error('conf_password')
              <div class="text-xs text-muted">{{ $errors->get('conf_password')[0] }}</div>
            @enderror
          </div>
          <div class="row my-4">
            <div class="col-12">
              <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" id="privacy_policy" type="checkbox" name="privacy_policy">
                <label class="custom-control-label" for="privacy_policy">
                  <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                </label>
              </div>
              @error('privacy_policy')
                <div class="text-xs text-muted">{{ $errors->get('privacy_policy')[0] }}</div>
              @enderror
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary mt-4">Create account</button>
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col">
        <small class="text-muted">Already have an account <a href="{{ route('login') }}" class="text-light">Sign in</a></small>
      </div>
    </div>
  </div>
</div>
@endsection