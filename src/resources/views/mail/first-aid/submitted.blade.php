<x-mail::message>
# First Response Validation Request

<small>Submitted: {{ $validation->created_at }}</small>

<x-mail::table>
| Validation Information |                                          |
| :--------------------- | :--------------------------------------- |
| Volunteer              | {{ $validation->name }}                  |
| Email                  | {{ $validation->email }}                 |
| Membership Number      | {{ $validation->membership }}            |
| Course Date            | {{ $validation->date->format('j M Y') }} |
</x-mail::table>

## Submitted Evidence
@foreach($validation->uploads()->get() as $upload)
* <x-mail::link :url="$upload->url()">{{ $upload->name }}</x-mail::link>
@endforeach

## Additional Information
{{ $validation->additional ?? "*None submitted*" }}
</x-mail::message>
