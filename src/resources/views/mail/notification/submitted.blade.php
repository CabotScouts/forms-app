<x-mail::message>
# Activity Notification

@if($notification->submitter_name)
Submitted on {{ $notification->created_at }} by {{ $notification->submitter_name }} ({{ $notification->submitter_email }})
@else
Submitted on {{ $notification->created_at }} by {{ $notification->lic_name }} ({{ $notification->lic_email }})
@endif

## Details
{{ $notification->description }}

<x-mail::table>
| Activity Information |                                 |
| :------------------- | :------------------------------ |
| Date                 | {{ $notification->date }}       |
| Leader in Charge     | {{ $notification->lic_name }}   |
| Email                | {{ $notification->lic_email }}  |
| Phone                | {{ $notification->lic_phone }}  |
</x-mail::table>

## Location
{{ $notification->location }}

<x-mail::table>
| Group & Section         |                                                        |
| :---------------------- | :----------------------------------------------------- |
| Group                   | {{ $notification->group }}                             |
| Section                 | {{ $notification->section }}                           |
@foreach(['squirrels', 'beavers', 'cubs', 'scouts', 'explorers', 'adults'] as $section)
@if($notification->getAttribute('number_'.$section))
| {{ ucfirst($section) }} | {{ $notification->getAttribute('number_'.$section) }}  |
@endif
@endforeach
| Lead Email              | {{ $notification->team_leader_email }}                 |
</x-mail::table>

@if($notification->activity_leader)
## Activity Leader/Permit Holder
{{ $notification->activity_leader }}
@endif

## inTouch Arrangements
{{ $notification->intouch }}

## Risk Assessments
@foreach($notification->uploads()->get() as $upload)
* <x-mail::link :url="$upload->url()">{{ $upload->name }}</x-mail::link>
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
