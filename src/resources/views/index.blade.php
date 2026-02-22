@extends('template')
@section('content')
  <div class="row row-cols-1 row-cols-md-2">

    <div class="col mb-2">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">Activity Notification</h3>
          <p class="card-text">
            This form is to notify the Cabot District team about activities which are taking place outside of the Defined 
            Urban Area, or for which the District requires further checks to be undertaken. Read the 
            <a href="https://cabotscouts.org.uk/volunteers/activities/" target="_blank">Activity Notification Requirements</a> 
            to determine if you need to submit a notification.
          </p>
        </div>
        <div class="card-footer">
          <a href="{{ route('notification.form') }}" class="btn btn-primary">Submit notification</a>
        </div>
      </div>
    </div>

    <div class="col mb-2">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">Report an Accident</h3>
          <p class="card-text">
            All accidents which occur in a Scouting Unit the District is responsible for (i.e. an Explorer Unit
            or Network) or during an event organised by a District team (e.g. Ten Tors or a training course) must be
            reported to the District using this form.
          </p>
        </div>

        <div class="card-footer">
          <a href="{{ route('accident.form') }}" class="btn btn-primary">Submit accident report</a>
        </div>
      </div>
    </div>

    <div class="col mb-2">
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
