<?php
$alerts = session('alert');
session()->forget('alert');
?>

@if ($alerts)
  @foreach ($alerts as $type => $message)
    <div class="alert alert-{{ $type }}">{!! $message !!}</div>
  @endforeach
@endif
