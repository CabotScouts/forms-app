@extends('template')
@section('title', 'Accident Report Submitted')
@section('content')
  <div class="row row-cols-1">

    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Accident Report Submitted</h2>

          <p class="card-text">
            Your accident report has been submitted.
          </p>

          @if ($report->further_reporting)
            <div class="alert alert-danger" role="alert">
              <p class="card-text font-weight-bold">
                Further reporting of this accident is required, the relevant lead volunteer will contact you for more
                information.
              </p>
            </div>
          @endif

          <table class="table table-striped table-bordered">
            <tbody>

              <tr>
                <th scope="row">Submitted</th>
                <td>{{ $report->created_at }}</td>
              </tr>

              <tr>
                <th scope="row">Reporter Name</th>
                <td>{{ $report->reporter_name }}</td>
              </tr>

              <tr>
                <th scope="row">Reporter Email</th>
                <td>{{ $report->reporter_email }}</td>
              </tr>

              <tr>
                <th scope="row">Reporting Unit</th>
                <td>{{ $report->reporting_unit }}</td>
              </tr>

              <tr>
                <th scope="row">Their Name</th>
                <td>{{ $report->their_name }}</td>
              </tr>
              <tr>
                <th scope="row">Their Date of Birth</th>
                <td>{{ $report->their_dob->format('d/m/Y') }}</td>
              </tr>

              @if ($report->their_unit)
                <tr>
                  <th scope="row">Their Unit</th>
                  <td>{{ $report->their_unit }}</td>
                </tr>
              @endif

              <tr>
                <th scope="row">When</th>
                <td>{{ $report->when->format('d/m/Y') }}</td>
              </tr>

              <tr>
                <th scope="row">Where</th>
                <td>{{ $report->where }}</td>
              </tr>

              <tr>
                <th scope="row">Accident Details</th>
                <td>{{ $report->details }}</td>
              </tr>

              <tr>
                <th scope="row">Treatment Given</th>
                <td>{{ $report->treatment }}</td>
              </tr>

              @if ($report->further_reporting)
                <tr class="table-danger">
                  <th scope="row">Further Reporting</th>
                  <td>Required</td>
                </tr>
              @endif

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
