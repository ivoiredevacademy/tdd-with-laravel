@component('mail::message')
# {{ $title }}

{{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
