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
          <h3 class="card-title">Internal First Aid Qualification</h3>
          <p class="card-text">Volunteers that have completed an internal qualification (a Scout First Response course
            delivered elsewhere in Scouting) will need to submit their certificate to the District in order to have their
            training recorded.</p>
        </div>

        <div class="card-footer">
          <a href="{{ route('fa.internal.form') }}" class="btn btn-primary">Submit qualification</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">External First Aid Qualification</h3>
          <p class="card-text">Any course that is set by a regulated body and covers the Scouts First Response criteria,
            recognition, and length requirements can be considered as a suitable alternative to a First Response
            course.All
            external qualifications must be checked and approved by a District First Response
            Trainer in order to confirm these requirements have been met.</p>

          <p class="card-text">Volunteers will need to submit their
            qualification certificate, along with relevant evidence in order to have their learning
            record updated.</p>

        </div>
        <div class="card-footer">
          <a href="{{ route('fa.external.form') }}" class="btn btn-primary">Submit qualification</a>
        </div>
      </div>
    </div>
  </div>
@endsection
