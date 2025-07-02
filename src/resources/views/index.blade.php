@extends('template')
@section('content')
  <div class="row row-cols-1 row-cols-md-2">
    {{-- <div class="card">
      <div class="card-body">
        <h3 class="card-title">Activity Notification</h3>
        <p class="card-text">
          Wordssssss
        </p>
      </div>
      <div class="card-footer">
        <a href="{{ route('notification.form') }}" class="btn btn-primary">Submit notification</a>
      </div>
    </div> --}}

    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">First Aid Validation</h3>
          <p class="card-text">
            First Aid training can only be added to a volunteers learning record by a District Learning Assessor, after
            a trainer has confirmed the First Response course criteria has been met. Volunteers will need to submit
            evidence from the course they have attended so a trainer can make the necessary checks and validate the
            training.
          </p>
        </div>

        <div class="card-footer">
          <a href="{{ route('fa.form') }}" class="btn btn-primary">Submit qualification for validation</a>
        </div>
      </div>
    </div>

  </div>
@endsection
