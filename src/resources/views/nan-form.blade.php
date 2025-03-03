@extends('template')
@section('title', 'Nights Away Notification')
@section('content')
<div class="row row-cols-1">
  <form action="{{ route('nan') }}" method="POST" id="notification">
    @csrf
    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Nights Away Notification</h2>
          <p class="card-text">
            This form provides the information a District Commissioner or their nominee requires to approve a nights
            away event to take place (<a href="https://www.scouts.org.uk/por/9-activities/#9.1.2" target="_blank"
              rel="noopener nofollower">POR 9.1.2</a>). The Permit holder is responsible for ensuring the appropriate
            Commissioner is informed about each section attending a nights away event, even a District or County event.
          </p>
          <p class="card-text">
            For all nights away events the information below should be submitted at least seven days before the event.
            Please also ensure your Group Scout Leader or District Explorer Scout Commissioner is aware of the event
            before submitting your notification.
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

    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Event Information</h4>

          <div class="form-group">
            <label for="event_type">Type of event</label>
            <input type="text" class="form-control" id="event-type" name="event_type"
              value="{{ old('event_type', $form) }}">
            <small class="form-text text-muted">
              For example: expedition, sleepover, family camp
            </small>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="event_group">Group*</label>
              <input type="text" class="form-control" id="event_group" name="event_group"
                value="{{ old('event_group', $form) }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for="event_section">Section/Explorer Unit*</label>
              <input type="text" class="form-control" id="event_section" name="event_section"
                value="{{ old('event_section', $form) }}" required>
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="form-group col-md-5">
              <label for="start_date">Start Date*</label>
              <input type="date" class="form-control" id="start_date" name="start_date"
                value="{{ old('start_date', $form) }}" required>
            </div>
            <div class="form-group col-md-5">
              <label for="end_date">End Date*</label>
              <input type="date" class="form-control" id="end_date" name="end_date"
                value="{{ old('end_date', $form) }}" required>
            </div>
            <div class="form-group col-md-2">
              <label for="number_nights">Number of nights*</label>
              <input type="number" min="0" class="form-control" id="number_nights" name="number_ nights"
                value="{{ old('number_nights', $form) }}" required>
            </div>
          </div>

          <h5 class="card-title">Venue</h5>
          <div class="form-row mb-3">
            <div class="form-group col-12 col-md-4">
              <label for="venue_name">Name*</label>
              <input type="text" class="form-control" id="venue_name" name="venue_name"
                value="{{ old('venue_name', $form) }}" required>
            </div>
            <div class="form-group col-12 col-md-4">
              <label for="venue_phone">Phone number</label>
              <input type="text" class="form-control" id="venue_phone" name="venue_phone"
                value="{{ old('venue_phone', $form) }}">
            </div>
            <div class="form-group col-12 col-md-4">
              <label for="venue_website">Website</label>
              <input type="text" class="form-control" id="venue_website" name="venue_website"
                value="{{ old('venue_website', $form) }}">
            </div>
            <div class="form-group col-12">
              <label for="venue_address">Address*</label>
              <textarea class="form-control" id="venue_address" name="venue_address" rows="5" required>{{ old('venue_address', $form) }}</textarea>
            </div>
          </div>

          <h5 class="card-title">Approximate numbers attending</h5>
          <div class="form-row">
            @foreach (['squirrels', 'beavers', 'cubs', 'scouts', 'explorers', 'adults'] as $section)
            <div class="form-group col-6 col-md-2">
              <label for="number_{{ $section }}">{{ ucfirst($section) }}</label>
              <input type="number" min="0" class="form-control" id="number_{{ $section }}"
                name="number_{{ $section }}" value="{{ old('number_' . $section, $form) }}">
            </div>
            @endforeach
          </div>
          <small class="form-text text-muted">
            Any Young Leaders attending should be counted in the Explorers column, Networkers should be counted in the
            adults column and included in the <em>Adults attending</em> field below.
          </small>
        </div>
      </div>
    </div>

    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Event Leadership</h4>

          <h5>Permit Holder</h5>
          <div class="form-row mb-3">
            <div class="form-group col-md-6">
              <label for="permit_name">Name*</label>
              <input type="text" class="form-control" id="permit_name" name="permit_name"
                value="{{ old('permit_name', $form) }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for="permit_number">Membership Number*</label>
              <input type="text" class="form-control" id="permit_number" name="permit_number"
                value="{{ old('permit_number', $form) }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for="permit_email">Email Address*</label>
              <input type="email" class="form-control" id="permit_email" name="permit_email"
                value="{{ old('permit_email', $form) }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for="permit_phone">Phone Number*</label>
              <input type="input" class="form-control" id="permit_phone" name="permit_phone"
                value="{{ old('permit_phone', $form) }}" required>
            </div>
          </div>

          <h5>Event Leader (if not Permit Holder)</h5>
          <div class="form-row mb-3">
            <div class="form-group col-md-6">
              <label for="leader_name">Name</label>
              <input type="text" class="form-control" id="leader_name" name="leader_name"
                value="{{ old('leader_name', $form) }}">
            </div>
            <div class="form-group col-md-6">
              <label for="leader_number">Membership Number</label>
              <input type="text" class="form-control" id="leader_number" name="leader_number"
                value="{{ old('leader_number', $form) }}">
            </div>
            <div class="form-group col-md-6">
              <label for="leader_email">Email Address</label>
              <input type="email" class="form-control" id="leader_email" name="leader_email"
                value="{{ old('leader_email', $form) }}">
            </div>
            <div class="form-group col-md-6">
              <label for="leader_phone">Phone Number</label>
              <input type="input" class="form-control" id="leader_phone" name="leader_phone"
                value="{{ old('leader_phone', $form) }}">
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="form-group col-md-12">
              <label for="adults_attending">
                <h5>Adults Attending</h5>
              </label>
              <textarea class="form-control" id="adults_attending" name="adults_attending" rows="8">{{ old('adults_attending', $form) }}</textarea>
              <small class="form-text text-muted">
                The names and membership numbers of all adults members attending as well as all other adults, e.g.
                parents, guardians, etc.
              </small>
            </div>
          </div>

          <h5>Event Passport</h5>
          <div class="form-row">
            <div class="form-group col-md-12">
              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" id="event_passport" name="event_passport"
                  @checked(old('event_passport', $form))>
                <label class="form-check-label" for="event_passport">
                  This event is being run using event passports
                </label>
              </div>
              <small class="form-text text-muted">
                A <a
                  href="https://www.scouts.org.uk/volunteers/running-your-section/planning-your-programme/nights-away-and-camping/nights-away-permit-scheme/the-nights-away-event-passport-guidance/"
                  target="_blank" rel="noopener nofollower">Nights Away Event Passport</a> enables young people in
                the Scout and Explorer Scout sections, who are deemed suitably skilled, to undertake a nights away
                activity as a peer group
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Planning and Preparation</h4>
          <div class="form-row mb-3">
            <div class="form-group col-md-12">
              <label for="activities">
                <h5>Activities</h5>
              </label>
              <textarea class="form-control" id="activities" name="activities" rows="8">{{ old('activities', $form) }}</textarea>
              <small class="form-text text-muted">
                Please list activities requiring permits or qualifications (including any planned contingency
                activities) providing details of the activity leader or provider.
              </small>
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="form-group col-md-12">
              <label for="intouch">
                <h5>inTouch Details*</h5>
              </label>
              <textarea class="form-control" id="intouch" name="intouch" rows="8" required>{{ old('intouch', $form) }}</textarea>
              <small class="form-text text-muted">
                Please provide details of your inTouch system and the main contacts in the event of an emergency.
              </small>
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="form-group col-12">
              <label for="risk_assessments">
                <h5>Risk Assessments*</h5>
              </label>
              @include('components.filepond', [
              'id' => 'risk_assessments',
              'name' => 'risk_assessments[]',
              'required' => true,
              ])
              <small class="form-text text-muted">
                You must provide a written risk assessment to cover the aspects of this nights away event which
                you are responsible for.
              </small>
              <small class="form-text text-muted">
                Multiple files can be submitted if necessary (maximum 5 files, 3MB per file,
                accepted filetypes are pdf, doc, docx, xls, xlsx).
              </small>
              </label>
            </div>
            <div class="form-group col-md-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirm_ra_shared" name="confirm_ra_shared"
                  @checked(old('confirm_ra_shared', $form)) required>
                <label class="form-check-label" for="confirm_ra_shared">
                  I confirm that the risks and control measures will be communicated to all adults and young people
                  involved in this event in an appropriate manner
                </label>
              </div>
            </div>
          </div>

          <div class="form-row mb-3">
            <div class="form-group col-md-12">
              <h5>Contingency Plans</h5>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="contingency_plans" name="contingency_plans"
                  @checked(old('contingency_plans', $form))>
                <label class="form-check-label" for="contingency_plans">
                  I confirm that if the planned activities cannot take place during this nights away event the
                  leadership team have considered alternatives and they will be carried out as per the local approval
                  process
                </label>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <h5>GSL/DESC Aware</h5>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="commissioner_aware" name="commissioner_aware"
                  @checked(old('commissioner_aware', $form))>
                <label class="form-check-label" for="commissioner_aware">
                  I confirm that the Group Scout Leader or District Explorer Scout Commissioner is aware of this event
                  taking place
                </label>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <button type="submit" class="btn btn-lg btn-primary" id="submit" name="submit" value="true">
            Submit notification
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@push('head-additional')
<link href="{{ asset('static/filepond.min.css') }}" rel="stylesheet">
{{-- if form has been rejected with validation errors we need to reset modified flag --}}
<script>
  var modified = {
    {
      old('submit') !== null ? 'true' : 'false'
    }
  };
</script>
@endpush
@push('body-additional')
<script src="{{ asset('static/filepond-plugin-file-validate-size.js') }}"></script>
<script src="{{ asset('static/filepond-plugin-file-validate-type.js') }}"></script>
<script src="{{ asset('static/filepond.min.js') }}"></script>

<script>
  let form = document.querySelector("#notification");
  if (form) {
    form.addEventListener('input', function(event) {
      modified = true; // flag when any form field is modified
    });
  }

  let button = document.querySelector("#submit");
  if (button) {
    button.addEventListener('click', function(event) {
      modified = false; // remove flag when we actually want to navigate away to submit the form
    });
  }

  window.addEventListener('beforeunload', (event) => {
    if (modified) {
      // check if the form has been modified before leaving the page to avoid data loss
      event.preventDefault();
      event.returnValue = '';
    }
  });

  FilePond.registerPlugin(
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType
  );

  FilePond.parse(document.body);
</script>
@endpush