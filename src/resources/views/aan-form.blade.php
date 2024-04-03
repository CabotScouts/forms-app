@extends('template')
@section('title', 'Adventurous Activity Notification')
@section('content')
  <div class="row row-cols-1">
    <form action="{{ route('aan') }}" method="POST">
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Adventurous Activity Notification</h2>
            <p class="card-text">
              Info about an AAN...
            </p>
            <p class="card-text">
              <strong>
                The event must not go ahead until the District Commissioner or their nominee has confirmed their
                approval.
              </strong>
            </p>
            <p class="card-text">
              <em>
                All fields marked with a * are required to submit a notification.
              </em>
            </p>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
