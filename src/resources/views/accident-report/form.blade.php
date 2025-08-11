@extends('template')
@section('title', 'Report an Accident')
@include('components.form-js')
@section('content')
  <div class="row row-cols-1">
    <form action="{{ route('accident.submit') }}" method="POST" id="submit">

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Report an Accident</h2>

            <p class="card-text">
              All accidents which occur in a Scouting Unit the District is responsible for (e.g. an Explorer Unit,
              Network) or during an event organised by a District team (e.g. Ten Tors, or a training course) must be
              reported to the District using this form.
            </p>

            <p class="card-text">
              <strong>
                In the case of a serious accident/incident, or one which leads to loss of life (or has the potential to),
                the HQ Duty Media officer must be advised immediately: <a href="tel:03453001818">0345 300 1818</a>.
              </strong>
            </p>

            @include('components.form-errors')
          </div>
        </div>
      </div>

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Who is reporting the accident?</h4>
            <div class="form-group">
              <label for="reporter_name">Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('reporter_name') is-invalid @enderror" id="reporter_name"
                name="reporter_name" value="{{ old('reporter_name') }}" required>
            </div>

            <div class="form-group">
              <label for="reporter_email">Email Address<span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('reporter_email') is-invalid @enderror" id="reporter_email"
                name="reporter_email" value="{{ old('reporter_email') }}" required>
              <small class="form-text text-muted">A copy of this report will be sent to you for your records</small>
            </div>

            <div class="form-group">
              <label for="reporting_unit">Reporting Unit<span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('reporting_unit') is-invalid @enderror" id="reporting_unit"
                name="reporting_unit" value="{{ old('reporting_unit') }}" required>
              <small class="form-text text-muted">
                Where in Scouting is this accident being reported from - for an Explorer activity this would be the
                Explorer Scout Unit, for Network: "Network", for other District activities then
                this is the relevant team which was responsible for organising this activity.
              </small>
            </div>

          </div>
        </div>
      </div>

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Who had the accident?</h4>

            <div class="form-group">
              <label for="their_name">Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('their_name') is-invalid @enderror" id="their_name"
                name="their_name" value="{{ old('their_name') }}" required>
            </div>

            <div class="form-group">
              <label for="their_dob">Date of Birth<span class="text-danger">*</span></label>
              <input type="date" class="form-control @error('their_dob') is-invalid @enderror" id="their_dob"
                name="their_dob" value="{{ old('their_dob') }}" required>
            </div>

            <div class="form-group">
              <label for="their_unit">Their Unit</label>
              <input type="text" class="form-control @error('their_unit') is-invalid @enderror" id="their_unit"
                name="their_unit" value="{{ old('their_unit') }}">
              <small class="form-text text-muted">
                If different from the Reporting Unit, which Scouting Unit (e.g. Scout Group, or Explorer Unit) is this
                person a member of
              </small>
            </div>

          </div>
        </div>
      </div>

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">What happened?</h4>

            <div class="form-group">
              <label for="when">When<span class="text-danger">*</span></label>
              <input type="date" class="form-control @error('when') is-invalid @enderror" id="when" name="when"
                value="{{ old('when') }}" required>
              <small class="form-text text-muted">When did the accident take place</small>
            </div>

            <div class="form-group">
              <label for="where">Where<span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('where') is-invalid @enderror" id="where"
                name="where" value="{{ old('where') }}" required>
              <small class="form-text text-muted">Where did the accident happen</small>
            </div>

            <div class="form-group">
              <label for="details">The Accident<span class="text-danger">*</span></label>
              <textarea class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="6"
                required>{{ old('details') }}</textarea>
              <small class="form-text text-muted">
                Explain how the accident happened - was there an activity taking place at the time, were there any other
                factors which lead to the accident occurring?
              </small>
            </div>

            <div class="form-group">
              <label for="treatment">Treatment Given</label>
              <textarea class="form-control @error('treatment') is-invalid @enderror" id="treatment" name="treatment"
                rows="6">{{ old('treatment') }}</textarea>
              <small class="form-text text-muted">Describe the treatment that was given, by who, and when</small>
            </div>

          </div>
        </div>
      </div>

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Further Reporting</h4>

            <p class="card-text">
              Some accidents require further reporting to headquarters. These are accidents where:
            </p>

            <p class="card-text">
            <ul>
              <li>
                Any person requires medical treatment (hospital, doctor, dentist etc.) either at the time of the
                accident, or subsequently because of the accident
              </li>
              <li>Rescue is required (coastguard, mountain rescue etc.)</li>
              <li>Damage is caused to third-party property</li>
              <li>There is a loss of life</li>
            </ul>
            </p>

            <p class="card-text">
              If this accident requires further reporting you will be contacted for the necessary additional information
              to make this report.
            </p>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="further_reporting" id="further_reporting"
                value="1" @checked(old('further_reporting'))>
              <label class="form-check-label" for="further_reporting">
                <strong>This accident requires further reporting</strong>
              </label>
            </div>
          </div>
        </div>
      </div>

      {{-- CAPTCHA, CSRF, and submit --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            {!! HCaptcha::display() !!}

            @csrf

            <button type="submit" class="btn btn-lg btn-primary" id="submit" name="submit" value="true">
              Submit accident report
            </button>
          </div>
        </div>
      </div>

    </form>
  </div>
@endsection
