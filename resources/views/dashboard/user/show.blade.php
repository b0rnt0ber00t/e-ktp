@extends('dashboard.app')

@section('title', 'User Detail')

@section('content-header')
<div class="row">
</div>
@endsection

@section('content-body')
<div class="row">
  <div class="col-md-7">
    <div class="card">
      <div class="row g-0">
        <div class="col-md-4 my-auto mx-auto">
          <img src="{{ asset('assets/img/user/profile/' . $id->image) }}" class="img-fluid rounded-start" alt="{{ $id->image }}">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h3 class="card-title">{{ $id->name }}</h3>
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
    <div class="card">
      <div class="card-header">
        Detail
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <tbody>
            <tr>
              <th scope="row">Nik</th>
              <td>: {{ $userDetail->nik }}</td>
            </tr>
            <tr>
              <td scope="row">KK</td>
              <td>: {{ $userDetail->kk }}</td>
            </tr>
            <tr>
              <td scope="row">Place</td>
              <td>: {{ $placeAndCity->name }}</td>
            </tr>
            <tr>
              <td scope="row">Birth Date</td>
              <td>: {{ $userDetail->birth_date }}</td>
            </tr>
            <tr>
              <td scope="row">Gender</td>
              <td>: {{ $userDetail->gender }}</td>
            </tr>
            <tr>
              <td scope="row">Blood Type</td>
              <td>: {{ $userDetail->blood_type }}</td>
            </tr>
            <tr>
              <td scope="row">RT / RW</td>
              <td>: {{ $userDetail->rt }} / {{ $userDetail->rw }}</td>
            </tr>
            <tr>
              <td scope="row">City</td>
              <td>: {{ $placeAndCity->name }}</td>
            </tr>
            <tr>
              <td scope="row">Village</td>
              <td>: {{ $villages->name }}</td>
            </tr>
            <tr>
              <td scope="row">District</td>
              <td>: {{ $districts->name }}</td>
            </tr>
            <tr>
              <td scope="row">Address</td>
              <td>: {{ $userDetail->address }}</td>
            </tr>
            <tr>
              <td scope="row">Citizenship</td>
              <td>: {{ $userDetail->citizenship }}</td>
            </tr>
            <tr>
              <td scope="row">Religion</td>
              <td>: {{ $userDetail->religion }}</td>
            </tr>
            <tr>
              <td scope="row">Profession</td>
              <td>: {{ $userDetail->profession }}</td>
            </tr>
            <tr>
              <td scope="row">Marriage</td>
              <td>: {{ $userDetail->marriage }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <div class="card-header">
        Attachment
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <tbody>
            <tr>
              <th scope="row">KK</th>
              <td>
                <a href="{{ asset('assets/img/user/profile/') . '/' . $id->id }}/{{ $userDetail->image_KK ?? '#' }}" download>{{ $userDetail->image_KK ?? 'none' }}</a>
              </td>
            </tr>
            <tr>
              <th scope="row">Transfer Certificate</th>
              <td>
                <a href="{{ asset('assets/img/user/profile/') . '/' . $id->id }}/{{ $userDetail->transfer_certificate ?? '#' }}" download>{{ $userDetail->transfer_certificate ?? 'none' }}</a>
              </td>
            </tr>
            <tr>
              <th scope="row">Certificate Moving Foreign</th>
              <td>
                <a href="{{ asset('assets/img/user/profile/') . '/' . $id->id }}/{{ $userDetail->Certificate_moving_foreign ?? '#' }}" download>{{ $userDetail->Certificate_moving_foreign ?? 'none' }}</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        Assessment
      </div>
      <div class="card-body">
        <div class="card-text">
          <button class="btn btn-success btn-approve" >Approve</button>
          <button class="btn btn-warning btn-decline" >Decline</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script>
  $(document).ready(() => {
    let btnApprove = $('.btn-approve')
    let btnDecine  = $('.btn-decline')

    btnApprove.click(() => {
      Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure to \"Approve\" the request!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!'
      }).then((result) => {
        if (result.value) {
          $.post("{{ route('user.edit', $id->id) }}", {
            _token: "{{ csrf_token() }}",
            _method: "PUT",
            assessment: "approve"
          }, (data) => {
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

    btnDecine.click(() => {
      Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure to \"Approve\" the request!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!'
      }).then((result) => {
        if (result.value) {
          $.post("{{ route('user.edit', $id->id) }}", {
            _token: "{{ csrf_token() }}",
            _method: "PUT",
            assessment: "decline"
          }, (data) => {
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