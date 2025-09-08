@extends('template')
@section('title', 'Activity Notification Submitted')
@section('content')
  <div class="row row-cols-1">

    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Activity Notification Submitted</h2>

          <p class="card-text">
            Your activity notification has been submitted.
          </p>

          <div class="alert alert-danger" role="alert">
            <p class="card-text font-weight-bold">
              The event must not go ahead until the District Lead Volunteer or a nominated member of the
              District Programme Team has confirmed their approval.
            </p>
          </div>

          <table class="table table-striped table-bordered">
            <tbody>

              <tr>
                <th scope="row">Submitted</th>
                <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
              </tr>

              @if ($notification->submitter_name)
                <tr>
                  <th scope="row">Submitter - Name</th>
                  <td>{{ $notification->submitter_name }}</td>
                </tr>
              @endif

              @if ($notification->submitter_email)
                <tr>
                  <th scope="row">Submitter - Email</th>
                  <td>{{ $notification->submitter_email }}</td>
                </tr>
              @endif

              <tr>
                <th scope="row">Leader in Charge - Name</th>
                <td>{{ $notification->lic_name }}</td>
              </tr>

              <tr>
                <th scope="row">Leader in Charge - Email</th>
                <td>{{ $notification->lic_email }}</td>
              </tr>

              <tr>
                <th scope="row">Leader in Charge - Phone Number</th>
                <td>{{ $notification->lic_phone }}</td>
              </tr>

              <tr>
                <th scope="row">Group</th>
                <td>{{ $notification->group }}</td>
              </tr>

              <tr>
                <th scope="row">Section</th>
                <td>{{ $notification->section }}</td>
              </tr>

              @foreach (['squirrels', 'beavers', 'cubs', 'scouts', 'explorers', 'adults'] as $section)
                <tr>
                  <th scope="row">{{ ucfirst($section) }}</th>
                  <td>{{ $notification->{'number_' . $section} ?? 0 }}</td>
                </tr>
              @endforeach

              <tr>
                <th scope="row">Date</th>
                <td>{{ $notification->date->format('d/m/Y') }}</td>
              </tr>

              <tr>
                <th scope="row">Location</th>
                <td>{{ $notification->location }}</td>
              </tr>

              <tr>
                <th scope="row">Activity Details</th>
                <td>{{ $notification->description }}</td>
              </tr>

              <tr>
                <th scope="row">Permit Holder Details</th>
                <td>{{ $notification->activity_leader }}</td>
              </tr>

              <tr>
                <th scope="row">Risk Assessments</th>
                <td>
                  <ul>
                    @foreach ($notification->uploads()->get() as $upload)
                      <li><a href="{{ $upload->url() }}">{{ $upload->name }}</a></li>
                    @endforeach
                  </ul>
                </td>
              </tr>

              <tr>
                <th scope="row">InTouch Information</th>
                <td>{{ $notification->intouch }}</td>
              </tr>

              <tr>
                <th scope="row">GLV/Team Leader</th>
                <td>{{ $notification->team_leader_email }}</td>
              </tr>

            </tbody>
          </table>



          <p class="card-text">
            <a href="#" class="btn btn-primary btn-lg d-print-none" onClick="window.print()">Print a copy</a>
          </p>

        </div>
      </div>
    </div>

  </div>
@endsection
