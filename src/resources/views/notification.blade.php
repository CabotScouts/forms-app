@extends('template')
@section('title', 'Activity Notification')
@section('content')
  <div class="row row-cols-1">
    <form action="{{ route('root.submit') }}" method="POST" id="notification">
      {{-- Form Introduction Header --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Activity Notification</h2>

            <p class="card-text">
              Speel about Activity Notifications in Cabot...
            </p>

            <p class="card-text">
              <strong>
                The event must not go ahead until the District Lead Volunteer or a nominated member of the
                District Programme Team has confirmed their approval.
              </strong>
            </p>

            @if ($errors->any())
              <div class="alert alert-danger mb-0">
                <strong>There are some issues with your notification:</strong>
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        </div>
      </div>

      {{-- Leader In Charge info --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Leader in Charge</h4>

            <div class="form-group">
              <label for="lic-name">Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="lic_name" name="lic-name"
                value="{{ old('lic-name', $form) }}" required>
            </div>

            <div class="form-group">
              <label for="lic-email">Email Address<span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="lic-email" name="lic-email"
                value="{{ old('lic-email', $form) }}" required>
            </div>

            <div class="form-group mb-0">
              <label for="lic-phone">Phone Number<span class="text-danger">*</span></label>
              <input type="tel" inputmode="numeric" pattern="[0-9]*" class="form-control" id="lic-phone"
                name="lic-phone" value="{{ old('lic-phone', $form) }}" required>
            </div>

          </div>
        </div>
      </div>

      {{-- Submitter info --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Your Details</h4>
            <p class="card-text">
              If you are not the Leader in Charge, please provide your details.
            </p>

            <div class="form-group">
              <label for="submitter-name">Name</label>
              <input type="text" class="form-control" id="submitter-name" name="submitter-name"
                value="{{ old('submitter-name', $form) }}">
            </div>

            <div class="form-group mb-0">
              <label for="submitter-email">Email Address</label>
              <input type="email" class="form-control" id="submitter-email" name="submitter-email"
                value="{{ old('submitter-email', $form) }}">
              <small class="form-text text-muted">A copy of this form will be sent to you for your records.</small>
            </div>

          </div>
        </div>
      </div>


      {{-- Section/Unit/Team info --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Section Information</h4>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="group">Group<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="group" name="group" value="{{ old('group', $form) }}"
                  required>
                <small class="form-text text-muted">
                  Enter <em>14-24</em> for Explorer or Network events, or <em>Programme Team</em> for District-organised
                  events.
                </small>
              </div>

              <div class="form-group col-md-12">
                <label for="section">Section/Explorer Unit/Programme Team<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="section" name="section"
                  value="{{ old('section', $form) }}" required>
              </div>
            </div>

            <h5>Approximate numbers attending</h5>
            <div class="form-row">
              @foreach (['squirrels', 'beavers', 'cubs', 'scouts', 'explorers', 'adults'] as $section)
                <div class="form-group col-6 col-md-2">
                  <label for="number-{{ $section }}">{{ ucfirst($section) }}</label>
                  <input type="number" min="0" class="form-control" id="number-{{ $section }}"
                    name="number-{{ $section }}" value="{{ old('number-' . $section, $form) }}">
                </div>
              @endforeach
            </div>
            <small class="form-text text-muted">
              Any Young Leaders attending should be counted in the Explorers column, Networkers should be counted in the
              adults column.
            </small>

          </div>
        </div>
      </div>


      {{-- Activity info --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Activity Information</h4>

            <div class="form-group">
              <label for="date">Date<span class="text-danger">*</span></label>
              <input type="date" class="form-control" id="date" name="date"
                value="{{ old('date', $form) }}" required>
            </div>

            <div class="form-group">
              <label for="location">Location<span class="text-danger">*</span></label>
              <textarea class="form-control" id="location" name="location" rows="4" required>{{ old('location', $form) }}</textarea>
            </div>

            <div class="form-group mb-0">
              <label for="description">Activity Description<span class="text-danger">*</span></label>
              <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $form) }}</textarea>
              <small class="form-text text-muted">
                Provide details of the activity that is going to be taking place.
              </small>
            </div>

          </div>
        </div>
      </div>

      {{-- Permit Holder info --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Permit Holder/Activity Leader</h4>

            <p class="card-text">
              Where the activity requires a permit holder or is being lead by an external activity provider, please
              provide details.
            </p>

            <div class="form-group">
              <label for="activity-leader">Details</label>
              <textarea class="form-control" id="activity-leader" name="activity-leader" rows="4">{{ old('activity-leader', $form) }}</textarea>
            </div>

            <div class="form-group mb-0">
              <label for="activity-leader-email">Contact Email</label>
              <input type="email" class="form-control" id="activity-leader-email" name="activity-leader-email"
                value="{{ old('activity-leader-email', $form) }}">
              <small class="form-text text-muted">
                A copy of this form will be sent to the permit holder/activity leader.
              </small>
            </div>

          </div>
        </div>
      </div>

      {{-- Risk Assessments --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Risk Assessments</h4>

            <p class="card-text">You must provide a written risk assessment to cover the aspects of this activity which
              you are responsible for.</p>

            <div class="form-group mb-0">
              <label for="risk-assessments">Upload Risk Assessments<span class="text-danger">*</span></label>

              @include('components.filepond', [
                  'id' => 'risk-assessments',
                  'name' => 'risk-assessments[]',
                  'required' => true,
              ])

              <small class="form-text text-muted">
                Multiple files can be submitted if necessary (maximum 5 files, 3MB per file, accepted filetypes are pdf,
                doc, docx, xls, xlsx).
                Uploaded files will be stored for three months after the activity date.
              </small>
            </div>

          </div>
        </div>
      </div>

      {{-- InTouch --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">InTouch Information</h4>

            <p class="card-text">
              An InTouch system must be put in place for all Scouting activities.
              <a href="https://www.scouts.org.uk/volunteers/running-your-section/programme-guidance/information-for-volunteers/intouch/"
                target="_blank" rel="nofollow noreferer">
                Read more about InTouch procedures.</a>
            </p>

            <div class="form-group mb-0">
              <label for="intouch">Activity InTouch Arrangements<span class="text-danger">*</span></label>
              <textarea class="form-control" id="intouch" name="intouch" rows="6" required>{{ old('intouch', $form) }}</textarea>
              <small class="form-text text-muted">
                Please provide details of your inTouch system and the main contacts in the event of an emergency.
              </small>
            </div>

          </div>
        </div>
      </div>

      {{-- Team Lead aware --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">GLV/Team Leader Aware</h4>

            <p class="card-text">
              Your Group Lead Volunteer (for Group Sections), 14-24 Team Leader (for District Sections),
              or District Programme Team Leader (for Programme Team organised activities) must be aware this activity is
              taking place.
            </p>

            <div class="form-group mb-0">
              <label for="team-leader-email">GLV/Team Leader Email<span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="team-leader-email" name="team-leader-email"
                value="{{ old('team-leader-email', $form) }}" required>
              <small class="form-text text-muted">
                A copy of this form will be sent to your GLV/Team Leader.
              </small>
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
    var modified = {{ old('submit') !== null ? 'true' : 'false' }};
  </script>
@endpush
@push('body-additional')
  {!! HCaptcha::script() !!}
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
