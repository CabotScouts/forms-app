@extends('template')
@section('content')
  <div class="row row-cols-1 row-cols-md-2">
    <div class="col mb-2">
      <div class="card">
        <div class="card-body h-100">
          <h3 class="card-title">Adventurous Activity Notification</h3>
          <p class="card-text">
            Wordssssss
          </p>
          <p class="card-text">
            <a href="{{ route('notification.form') }}" class="btn btn-primary">Submit notification</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col mb-2">
      <div class="card">
        <div class="card-body h-100">
          <h3 class="card-title">First Response Recording</h3>
          <p class="card-text">Wordssss</p>

          <p class="card-text">
            <a href="{{ route('root') }}" class="btn btn-primary">Request Accreditation</a>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
