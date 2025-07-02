@extends('template')
@section('title', 'External First Aid')
@include('components.form-js')
@section('content')
  <div class="row row-cols-1">
    <form action="{{ route('fa.external.submit') }}" method="POST" id="submit">

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">External First Aid Qualification</h2>

            <p class="card-text">
              Any course that is set by a regulated body and covers the Scouts First Response criteria, recognition, and
              length requirements can be considered as a suitable alternative to a First Response course.
            </p>

            <p class="card-text">
              All external qualifications must be checked and approved by a District First Response Trainer in order to
              confirm these requirements have been met. Volunteers will need to submit their qualification certificate,
              along with <a href="https://cabotscouts.org.uk/volunteers/first-aid-training/recording-training/#evidence"
                target="_blank">necessary evidence</a> to have their learning record updated.
            </p>

            <p class="card-text">More information about recording First Aid training can be found on the
              <a href="https://cabotscouts.org.uk/volunteers/first-aid-training/recording-training/"
                target="_blank">District website</a>.
            </p>

            @include('components.form-errors')
          </div>
        </div>
      </div>

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Volunteer Information</h4>

            <div class="form-group">
              <label for="name">Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $form) }}" required>
            </div>

            <div class="form-group">
              <label for="email">Email Address<span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" value="{{ old('email', $form) }}" required>
            </div>

            <div class="form-group mb-0">
              <label for="membership">Membership Number<span class="text-danger">*</span></label>
              <input type="input" class="form-control @error('membership') is-invalid @enderror" id="membership"
                name="membership" value="{{ old('membership', $form) }}" required>
            </div>

          </div>
        </div>
      </div>

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Upload evidence</h4>

            <p class="card-text">
              You must provide:
            </p>
            <p class="card-text">
            <ul>
              <li>The certificate from your external first aid course</li>
              <li>
                A <a
                  href="https://cabotscouts.org.uk/wp-content/uploads/2025/06/first-response-checklist-for-external-courses.pdf"
                  target="_blank">signed checklist</a> from your external course trainer showing which First Response
                criteria your course
                covered
              </li>
            </ul>
            </p>

            <p class="card-text">
              If you attended a <em>First Aid at Work</em>, <em>Emergency First Aid at Work</em> or <em>RYA First Aid</em>
              couse, you must also provide:
            </p>
            <p class="card-text">
            <ul>
              <li>The certificate from the relevent <a href="https://hampshire-scouts.thinkific.com/"
                  target="_blank">Hampshire e-learning conversion course</a></li>
            </ul>
            </p>

            <div class="form-group mb-0">
              <label for="filepond">Upload evidence<span class="text-danger">*</span></label>

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

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Course Information</h4>

            <div class="form-group">
              <label for="date">Course Date<span class="text-danger">*</span></label>
              <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
                value="{{ old('date', $form) }}" required>
            </div>

            <div class="form-group mb-0">
              <label for="additional">Please provide the name of the Awarding Organisation for the external first aid
                course.</label>
              <textarea class="form-control @error('additional') is-invalid @enderror" id="additional" name="additional"
                rows="4">{{ old('additional', $form) }}</textarea>
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

            <input name="uploads" id="uploads" type="hidden" value="">
            <button type="submit" class="btn btn-lg btn-primary" id="submit" name="submit" value="true">
              Submit external qualification
            </button>
          </div>
        </div>
      </div>

    </form>
  </div>
@endsection
