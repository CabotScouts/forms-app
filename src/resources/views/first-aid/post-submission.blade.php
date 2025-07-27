@extends('template')
@section('title', 'First Aid Validation Submitted')
@section('content')
  <div class="row row-cols-1">

    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">Validation Request Submitted</h3>
          <p class="card-text">
            Your validation request has been submitted.
          </p>

          <div class="alert alert-danger">
            <p class="card-text font-weight-bold">
              Until you have been told your qualification has been accepted you may not have valid First Response training
              in place.
            </p>
            <p class="card-text">
              If you have existing First Response training which is expiring please check the date for this, your training
              will not be valid after this date if we have not yet been able to validate your qualification.
            </p>
            <p class="card-text">
              Please talk to your Lead Volunteer if you are unsure when your training expires or you have any questions.
            </p>
          </div>

          <p class="card-text">
            We aim to have your First Response training updated within a month but this may take longer if:
          </p>

          <p class="card-text">
          <ul>
            <li>we need additional evidence to be submitted</li>
            <li>you have further e-learning to complete</li>
            <li>
              you are required to attend a Child CPR demonstration session to meet the necessary First Response criteria
            </li>
          </ul>
          </p>

        </div>
      </div>
    </div>

  </div>
@endsection
