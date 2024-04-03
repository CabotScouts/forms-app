@extends('template')
@section('content')
  <div class="row row-cols-1 row-cols-md-2">
    <div class="col mb-2">
      <div class="card">
        <div class="card-body h-100">
          <h3 class="card-title">Nights Away Notification</h3>
          <p class="card-text">
            A Nights Away Notification (NAN) needs to be submitted as soon as possible (at least seven
            days) before your nights away event.
          </p>
          <p class="card-text">
            Before submitting the notification you will need to complete any relevant risk assessments, ready to attach to
            the form. You will also need the approximate numbers of young people attending as well as the name and
            membership number of all adults attending the event.
          </p>
          <p class="card-text">
            More information about the nights away permit scheme and nights away events can be found <a
              href="https://www.scouts.org.uk/volunteers/running-your-section/planning-your-programme/nights-away-and-camping/nights-away-resources/"
              target="_blank" rel="noopener nofollower">on the Scouts website</a>.
          </p>
          <p class="card-text">
            <a href="{{ route('nan') }}" class="btn btn-primary btn-lg">Start notification</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col mb-2">
      <div class="card">
        <div class="card-body h-100">
          <h3 class="card-title">Adventurous Activity Notification</h3>
          <p class="card-text">An Adventurous Activity Notification (AAN).....</p>

          <p class="card-text">
            <a href="{{ route('aan') }}" class="btn btn-primary btn-lg">Start notification</a>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
