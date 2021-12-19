@extends('dashboard.app')

@section('title', 'User Profile')

@section('content-header')
<div class="row mb-4">
  <div class="col-lg-7 col-md-10">
    <h1 class="display-2 text-white">Hello {{ auth()->user()->name }}</h1>
    <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
    <button class="btn btn-neutral btn-profile">Edit profile</button>
    <button class="btn btn-neutral btn-password">Change password</button>
    @if (auth()->user()->hasRole('User') && auth()->user()->hasDetail())
        <button class="btn btn-neutral {{ auth()->user()->requested() ?? 'btn-request' }}" >
          {{ auth()->user()->requested() ? 'E-KTP Requested' : 'Request E-KTP' }}
        </button>
    @endif
  </div>
</div>
@if (session()->has('info'))
  <div class="alert alert-info">{{ session()->get('info') }}</div>
@endif
@if ($errors->any())
  <div class="alert alert-info">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
@endsection

@section('content-body')
<div class="row mt-4">
  <div class="col-xl-4 order-xl-2">
    <div class="card card-profile">
      <img src="{{ asset('assets/img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
      <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
          <div class="card-profile-image">
            <a href="#">
              <img src="{{ asset('assets/img/user/profile/' . auth()->user()->image) }}" class="rounded-circle">
            </a>
          </div>
        </div>
      </div>
      <div class="card-body pt-6">
        <div class="text-center">
          <h5 class="h3">
            {{ auth()->user()->name }}
          </h5>
          <div class="h5 font-weight-300">
            <i class="ni ni-email-83 mr-2"></i>{{ auth()->user()->email }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-8 order-xl-1 form-profile d-none">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">Edit profile</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('user.update', 'profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
          <h6 class="heading-small text-muted mb-4">User information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg">
                <div class="form-group">
                  <label class="form-control-label" for="name">Name</label>
                  <input type="text" id="name" class="form-control" placeholder="First name" value="{{ auth()->user()->name }}" name="name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="email">Email address</label>
                  <input type="email" id="email" class="form-control" value="{{ auth()->user()->email }}" name="email">
                </div>
              </div>
              <div class="col-lg-6">
                <label class="form-control-label" for="image">Image <span class="text-sm text-muted">(dimensions 1:1)</span></label>
                <div class="custom-file">
                  <input type="file" class="custom-file" id="image" name="image">
                  <label class="custom-file-label" for="image">Choose file</label>
                </div>
              </div>
            </div>
          </div>
          @if (auth()->user()->hasRole('User'))
          <hr class="my-4" />
            <!-- Credential -->
            <h6 class="heading-small text-muted mb-4">Credential information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="kk">No. KK <span class="text-danger">*</span> </label>
                    <input type="number" id="kk" class="form-control" name="kk" placeholder="123456**********" value="{{ $userDetail ? $userDetail->kk : '' }}">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="nik">NIK <span class="text-danger">*</span> </label>
                    <input type="number" id="nik" class="form-control" name="nik" placeholder="123456**********" value="{{ $userDetail ? $userDetail->nik : '' }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="place">Place <span class="text-danger">*</span> </label>
                    <select id="place" class="form-control selectize" name="place">
                      @foreach ($regencies as $regency)
                        <option value="{{ $regency->id }}" {{ $regency->id == $userDetail->place ? 'selected' : '' }}>{{ $regency->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="birth_date">Birth date <span class="text-danger">*</span> </label>
                    <input type="date" id="birth_date" class="form-control" name="birth_date" value="{{ $userDetail ? $userDetail->birth_date : '' }}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="gender">Gender <span class="text-danger">*</span> </label>
                    <select class="form-control" id="gender" name="gender">
                      <option value="Male" {{ $userDetail->gender == 'Male' ? 'selected' : '' }}>Male</option>
                      <option value="Female" {{ $userDetail->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="blood_type">Blood type <span class="text-danger">*</span> </label>
                    <select class="form-control" id="blood_type" name="blood_type">
                      <option value="A" {{ $userDetail->blood_type == 'A' ? 'selected' : '' }}>A</option>
                      <option value="B" {{ $userDetail->blood_type == 'B' ? 'selected' : '' }}>B</option>
                      <option value="AB" {{ $userDetail->blood_type == 'AB' ? 'selected' : '' }}>AB</option>
                      <option value="O" {{ $userDetail->blood_type == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rt">RT <span class="text-danger">*</span> </label>
                    <input type="number" id="rt" class="form-control" placeholder="RT" name="rt" value="{{ $userDetail ? $userDetail->rt : '' }}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rw">RW <span class="text-danger">*</span> </label>
                    <input type="number" id="rw" class="form-control" placeholder="RW" name="rw" value="{{ $userDetail ? $userDetail->rw : '' }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="city">City <span class="text-danger">*</span> </label>
                    <select id="city" class="form-control" name="city">
                      @foreach ($regencies as $regency)
                        <option value="{{ $regency->id }}" {{ $regency->id == $userDetail->city ? 'selected' : '' }}>{{ $regency->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="village">Village <span class="text-danger">*</span> </label>
                    <select id="city" class="form-control" name="village">
                      @foreach ($villages as $village)
                        <option value="{{ $village->id }}" {{ $village->id == $userDetail->village ? 'selected' : '' }}>{{ $village->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="district">District <span class="text-danger">*</span> </label>
                    <select id="city" class="form-control" name="district">
                      @foreach ($districts as $district)
                        <option value="{{ $district->id }}" {{ $district->id == $userDetail->district ? 'selected' : '' }}>{{ $district->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="form-control-label" for="address">Address <span class="text-danger">*</span> </label>
                    <input id="address" class="form-control" placeholder="Home Address" type="text" name="address" value="{{ $userDetail ? $userDetail->address : '' }}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="citizenship">Citizenship <span class="text-danger">*</span> </label>
                    <select class="form-control" id="citizenship" name="citizenship">
                      <option value="WNI" {{ $userDetail->citizenship == 'WNI' ? 'selected' : '' }}>WNI</option>
                      <option value="WNA" {{ $userDetail->citizenship == 'WNA' ? 'selected' : '' }}>WNA</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="religion">Religion <span class="text-danger">*</span> </label>
                    <select class="form-control" id="religion" name="religion">
                      <option value="Islam"  {{ $userDetail->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                      <option value="Protestan"  {{ $userDetail->religion == 'Protestan' ? 'selected' : '' }}>Protestan</option>
                      <option value="Katolik"  {{ $userDetail->religion == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                      <option value="Hindu"  {{ $userDetail->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                      <option value="Buddha"  {{ $userDetail->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                      <option value="Khonghucu"  {{ $userDetail->religion == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="profession">Profession <span class="text-danger">*</span> </label>
                    <select class="form-control" id="profession" name="profession">
                      <option value="Unemployed" {{ $userDetail->profession == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                      <option value="Pengusaha" {{ $userDetail->profession == 'Pengusaha' ? 'selected' : '' }}>Pengusaha</option>
                      <option value="Wiraswasta" {{ $userDetail->profession == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                      <option value="Wirausaha" {{ $userDetail->profession == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                      <option value="Ibu rumahtangga" {{ $userDetail->profession == 'Ibu rumahtangga' ? 'selected' : '' }}>Ibu rumahtangga</option>
                      <option value="Petani" {{ $userDetail->profession == 'Petani' ? 'selected' : '' }}>Petani</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="marriage">Marriage <span class="text-danger">*</span> </label>
                    <select class="form-control" id="marriage" name="marriage">
                      <option value="Married" {{ $userDetail->marriage == 'Married' ? 'selected' : '' }}>Married</option>
                      <option value="Not married" {{ $userDetail->marriage == 'Not married' ? 'selected' : '' }}>Not married</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <label class="form-control-label" for="image_KK">Soft copy KK <span class="text-danger">*</span> </label>
                  <div class="custom-file">
                    <input type="file" class="custom-file" id="image_KK" name="image_KK">
                    <label class="custom-file-label" for="image_KK">Choose file</label>
                  </div>
                </div>
                <div class="col-lg-4">
                  <label class="form-control-label" for="transfer_certificate">Transfer certificate</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file" id="transfer_certificate">
                    <label class="custom-file-label" for="transfer_certificate" name="transfer_certificate">Choose file</label>
                  </div>
                </div>
                <div class="col-lg-4">
                  <label class="form-control-label" for="Certificate_moving_foreign">Certificate of moving from foreign</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file" id="Certificate_moving_foreign">
                    <label class="custom-file-label" for="Certificate_moving_foreign" name="Certificate_moving_foreign">Choose file</label>
                  </div>
                </div>
              </div>
            </div>
          @endif
          <hr class="my-4" />
          <h6 class="heading-small text-muted mb-4">Verify password</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label" for="verify_password">Verify password <span class="text-danger">*</span> </label>
                  <input type="password" id="verify_password" class="form-control" name="verify_password" placeholder="Verify password">
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-primary my-4">Update</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-xl-8 order-xl-1 form-password d-none">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">Change password</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('user.update', 'password') }}" method="POST">
        @csrf
        @method('PUT')
          <h6 class="heading-small text-muted mb-4">Password</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg">
                <div class="form-group">
                  <label class="form-control-label" for="old_password">Old password</label>
                  <input type="password" id="old_password" class="form-control" placeholder="Old password" name="old_password">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="new_password">New password</label>
                  <input type="password" id="new_password" class="form-control" placeholder="New password" name="new_password">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="confirm_password">Confirm password</label>
                  <input type="password" id="confirm_password" class="form-control" placeholder="Confirm password" name="confirm_password">
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-primary my-4">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script>
  $(document).ready(() => {
    let btn_profile  = $('.btn-profile')
    let btn_password = $('.btn-password')
    let btn_request  = $('.btn-request')

    btn_profile.click(() => {
      $('.form-profile').hasClass('d-none')
      ? $('.form-profile').removeClass('d-none')
      : $('.form-profile').addClass('d-none')

      !$('.form-password').hasClass('d-none') ? $('.form-password').addClass('d-none') : null
    })

    btn_password.click(() => {
      $('.form-password').hasClass('d-none')
      ? $('.form-password').removeClass('d-none')
      : $('.form-password').addClass('d-none')

      !$('.form-profile').hasClass('d-none') ? $('.form-profile').addClass('d-none') : null
    })

    btn_request.click(() => {
      Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure to request E-KTP!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!'
      }).then((result) => {
        if (result.value) {
          $.get("{{ route('user.register') }}", (data) => {
            if (parseInt(data) == 1) {
              Swal.fire({
                title: 'Success!',
                text: 'Your data has been registered!',
                icon: 'success'
              }).then(() => { location.reload() })
            } else {
              Swal.fire({
                title: 'Failed!',
                text: 'Your data was not complated!',
                icon: 'error'
              }).then(() => { location.reload() })
            }
          })
        }
      })
    })
  })
</script>
@endpush
