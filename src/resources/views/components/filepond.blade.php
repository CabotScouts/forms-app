<input 
  type="file"
  id="{{ $id }}"
  class="filepond"
  name="{{ $name }}"
  multiple data-allow-reorder="true"
  data-max-file-size="3MB" data-max-files="5"
  accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
  @required($required ?? false)>
