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
    let form = document.querySelector("#form");
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
        document.getElementById("uploads").value = JSON.stringify(uploads);
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
