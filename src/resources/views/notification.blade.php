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
              <label for="lic_name">Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('lic_name') is-invalid @enderror" id="lic_name"
                name="lic_name" value="{{ old('lic_name', $form) }}" required>
            </div>

            <div class="form-group">
              <label for="lic_email">Email Address<span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('lic_email') is-invalid @enderror" id="lic_email"
                name="lic_email" value="{{ old('lic_email', $form) }}" required>
            </div>

            <div class="form-group mb-0">
              <label for="lic_phone">Phone Number<span class="text-danger">*</span></label>
              <input type="tel" inputmode="numeric" pattern="[0-9]*"
                class="form-control @error('lic_phone') is-invalid @enderror" id="lic_phone" name="lic_phone"
                value="{{ old('lic_phone', $form) }}" required>
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
              If you are not the Leader in Charge, please provide your name and email address.
            </p>

            <div class="form-group">
              <label for="submitter_name">Name</label>
              <input type="text" class="form-control @error('submitter_name') is-invalid @enderror" id="submitter_name"
                name="submitter_name" value="{{ old('submitter_name', $form) }}">
            </div>

            <div class="form-group mb-0">
              <label for="submitter_email">Email Address</label>
              <input type="email" class="form-control @error('submitter_email') is-invalid @enderror"
                id="submitter_email" name="submitter_email" value="{{ old('submitter_email', $form) }}">
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
                <input type="text" class="form-control @error('group') is-invalid @enderror" id="group"
                  name="group" value="{{ old('group', $form) }}" required>
                <small class="form-text text-muted">
                  Enter <em>14-24</em> for Explorer or Network events, or <em>Programme Team</em> for District-organised
                  events.
                </small>
              </div>

              <div class="form-group col-md-12">
                <label for="section">Section/Explorer Unit/Programme Team<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('section') is-invalid @enderror" id="section"
                  name="section" value="{{ old('section', $form) }}" required>
              </div>
            </div>

            <h5>Numbers attending</h5>
            <div class="form-row">
              @foreach (['squirrels', 'beavers', 'cubs', 'scouts', 'explorers', 'adults'] as $section)
                <div class="form-group col-6 col-md-2">
                  <label for="number_{{ $section }}">{{ ucfirst($section) }}</label>
                  <input type="number" min="0"
                    class="form-control @error('number_' . $section) is-invalid @enderror"
                    id="number_{{ $section }}" name="number_{{ $section }}"
                    value="{{ old('number_' . $section, $form) }}">
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
              <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                name="date" value="{{ old('date', $form) }}" required>
            </div>

            <div class="form-group">
              <label for="location">Location<span class="text-danger">*</span></label>
              <textarea class="form-control @error('location') is-invalid @enderror" id="location" name="location" rows="4"
                required>{{ old('location', $form) }}</textarea>
            </div>

            <div class="form-group mb-0">
              <label for="description">Activity Details<span class="text-danger">*</span></label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                rows="4" required>{{ old('description', $form) }}</textarea>
              <small class="form-text text-muted">
                Provide a description of the activity that is going to be taking place.
              </small>
            </div>

          </div>
        </div>
      </div>

      {{-- Permit Holder info --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Permit Holder/External Activity Details</h4>

            <p class="card-text">
              Where the activity requires a permit holder or is being lead by an external activity provider, please
              provide details to explain how you are meeting the Scouting requirements for this activity.
            </p>

            <p class="card-text">
            <ul>
              <li><a
                  href="https://www.scouts.org.uk/volunteers/running-your-section/programme-guidance/information-for-volunteers/general-activity-guidance/"
                  target="_blank" rel="noreferrer">
                  General activities guidance
                </a></li>
              <li><a
                  href="https://www.scouts.org.uk/volunteers/running-your-section/programme-guidance/information-for-volunteers/general-activity-guidance/externally-led-activities/"
                  target="_blank" rel="noreferrer">
                  Externally led activities guidance
                </a></li>
            </ul>
            </p>

            <div class="form-group mb-0">
              <label for="activity_leader">Permit Holder/External Activity Details</label>
              <textarea class="form-control @error('activity_leader') is-invalid @enderror" id="activity_leader"
                name="activity_leader" rows="4">{{ old('activity_leader', $form) }}</textarea>
              <small class="form-text text-muted">
                For permit holders provide names, contact details, and information about their permits, and for externally
                led activities please provide the provider's address, contact details, and AALA number if required.
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

            <p class="card-text">
              You must provide risk assessments to cover the aspects of this activity which
              you are responsible for.
            </p>

            <p class="card-text">
            <ul>
              <li><a href="https://www.scouts.org.uk/volunteers/staying-safe-and-safeguarding/risk-assessments/"
                  target="_blank" rel="noreferrer">
                  Discover more about risk assessments
                </a></li>
            </ul>
            </p>

            <div class="form-group mb-0">
              <label for="filepond">Upload Risk Assessments<span class="text-danger">*</span></label>

              @include('components.filepond', [
                  'id' => 'filepond',
                  'name' => 'file',
                  'required' => true,
              ])

              <small class="form-text text-muted">
                Multiple files can be submitted if necessary (maximum 5 files, 3MB per file, accepted filetypes are pdf,
                doc, docx, xls, xlsx).
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
              Whenever any activity, event or meeting is run within Scouts, it's a requirement that an InTouch system is
              put in place.
            </p>

            <p class="card-text">
            <ul>
              <li><a
                  href="https://www.scouts.org.uk/volunteers/running-your-section/programme-guidance/information-for-volunteers/intouch/"
                  target="_blank" rel="noreferrer">
                  Setting up an InTouch system
                </a></li>
            </ul>
            </p>

            <div class="form-group mb-0">
              <label for="intouch">Activity InTouch Arrangements<span class="text-danger">*</span></label>
              <textarea class="form-control @error('intouch') is-invalid @enderror" id="intouch" name="intouch" rows="6"
                required>{{ old('intouch', $form) }}</textarea>
              <small class="form-text text-muted">
                Please provide details of your InTouch system and the main contacts in the event of an emergency.
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
              <label for="team_leader_email">GLV/Team Leader Email<span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('team_leader_email') is-invalid @enderror"
                id="team_leader_email" name="team_leader_email" value="{{ old('team_leader_email', $form) }}"
                required>
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

            <input name="risk_assessments" id="risk_assessments" type="hidden" value="">
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
        var uploads = [];
        document.getElementsByName("file").forEach((element) => uploads.push(element.value));
        document.getElementById("risk_assessments").value = JSON.stringify(uploads);
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

    FilePond.setOptions({
      server: {
        url: '/filepond/api',
        process: {
          url: "/process",
          headers: (file) => {
            return {
              "Upload-Name": file.name,
              "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
          },
        },
        revert: '/process',
        patch: "?patch=",
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      }
    });

    FilePond.parse(document.body);
  </script>
@endpush
