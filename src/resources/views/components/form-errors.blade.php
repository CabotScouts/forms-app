 @if ($errors->any())
   <div class="alert alert-danger mb-0">
     <strong>There are some issues with your submission:</strong>
     <ul class="mb-0">
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
     </ul>
   </div>
 @endif
