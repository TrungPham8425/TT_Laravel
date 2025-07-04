@props(['type' => 'success', 'message' => ''])

{{-- Component hiển thị thông báo dạng alert --}}
@php
$color = match($type) {
'success' => 'green',
'error' => 'red',
'warning' => 'orange',
default => 'gray',
};
@endphp

@if($message)
<div style="padding: 10px; border: 1px solid {{ $color }}; background-color: #f9f9f9; color: {{ $color }}; margin-bottom: 10px;">
    {{ $message }}
</div>
@endif