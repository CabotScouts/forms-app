@extends('template')
@section('title', 'Internal First Aid')
@include('components.form-js')
@section('content')
  <div class="row row-cols-1">
    <form action="{{ route('fa.internal.submit') }}" method="POST" id="submit">

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Internal First Aid Qualification</h2>

            <p class="card-text">
              Volunteers that have completed an internal qualification (a Scout First Response course
              delivered elsewhere in Scouting) will need to submit their certificate to the District in order to have
              their training recorded.
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
              You must provide
            </p>
            <p class="card-text">
            <ul>
              <li>the certificate from your internal first aid course</li>
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

      {{-- CAPTCHA, CSRF, and submit --}}
      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            {!! HCaptcha::display() !!}

            @csrf

            <input name="uploads" id="uploads" type="hidden" value="">
            <button type="submit" class="btn btn-lg btn-primary" id="submit" name="submit" value="true">
              Submit internal qualification
            </button>
          </div>
        </div>
      </div>

    </form>
  </div>
@endsection
