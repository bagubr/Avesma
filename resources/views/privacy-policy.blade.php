@php
    $html_data = \App\Models\PrivacyPolicy::find(1)->description;
@endphp
{!! $html_data !!}