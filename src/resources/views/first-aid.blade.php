@extends('template')
@section('title', 'Internal First Aid')
@include('components.form-js')
@section('content')
  <div class="row row-cols-1">
    <form action="{{ route('fa.submit') }}" method="POST" id="submit">

      <div class="col mb-2">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">First Aid Validation</h2>

            <p class="card-text">
              First Aid training can only be added to a volunteers learning record by a District Learning Assessor, after
              a trainer has confirmed the First Response course criteria has been met. Volunteers will need to submit
              evidence from the course they have attended so a trainer can make the necessary checks and validate the
              training.
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
              If your First Aid course was an <strong>internal</strong> course (First Response training delivered within
              Scouting), you should provide:
            </p>
            <p class="card-text">
            <ul>
              <li>the certificate from your internal first aid course</li>
            </ul>
            </p>

            <p class="card-text">
              If you attended an <strong>external</strong> course (a First Aid course delivered outside of Scouting, by a
              regulated body) you should provide:
            </p>
            <p class="card-text">
            <ul>
              <li>The certificate from your external first aid course</li>
              <li>
                A <a
                  href="https://cabotscouts.org.uk/wp-content/uploads/2025/06/first-response-checklist-for-external-courses.pdf"
                  target="_blank">signed checklist</a> from your external course trainer showing which First Response
                criteria your course covered, if you have this
              </li>
              <li>If you attended a <em>First Aid at Work</em>, <em>Emergency First Aid at Work</em> or <em>RYA First
                  Aid</em>
                course, you should also provide the certificate from the relevent <a
                  href="https://hampshire-scouts.thinkific.com/" target="_blank">Hampshire e-learning conversion
                  course</a></li>
            </ul>
            </p>

            <p class="card-text">
              Ideally, you should submit your evidence as PDF files, and if possible <a
                href="https://www.adobe.com/uk/acrobat/online/merge-pdf.html" target="_blank" rel="nofollow">merge
                multiple PDF files into a single file</a>.
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
              <small class="form-text text-muted">
                If you have completed multiple elements (an external course, and e-learning) this should be the earliest
                date.
              </small>
            </div>

            <div class="form-group mb-0">
              <label for="additional">
                If it is not visible on your certificate, please provide the name and membership number of the First
                Response Trainer who delivered the internal course you attended, or the name of the Awarding Organisation
                for an external first aid course.
              </label>
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
              Submit qualification for validation
            </button>
          </div>
        </div>
      </div>

    </form>
  </div>
@endsection
