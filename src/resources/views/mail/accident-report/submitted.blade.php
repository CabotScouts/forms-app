<x-mail::message>
# Accident Report

<small>Submitted: {{ $report->created_at }}</small>

@if($report->further_reporting)
<x-mail::panel>
**This accident requires further reporting, contact the reporter for additional information**
</x-mail::panel>
@endif

<x-mail::table>
| Accident            |                                           |
| :------------------ | :---------------------------------------- |
| Reporter Name       | {{ $report->reporter_name }}              |
| Reporter Email      | {{ $report->reporter_email }}             |
| Reporting Unit      | {{ $report->reporting_unit }}             |
| Their Name          | {{ $report->their_name }}                 |
| Their Date of Birth | {{ $report->their_dob->format('d/m/Y') }} |
| Their Unit          | {{ $report->their_unit }}                 |
| When                | {{ $report->when->format('d/m/Y') }}      | 
| Where               | {{ $report->where }}                      | 
</x-mail::table>

## Accident Details
{{ $report->details }}

## Treatment Given
{{ $report->treatment ?? "*None submitted*" }}
</x-mail::message>
