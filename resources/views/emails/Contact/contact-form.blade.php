@component('mail::message')

     # Thank you for your email

<strong>Name: </strong> {{ $data['name'] }}
<strong>Email: </strong> {{ $data['email'] }}
<strong>Website: </strong> {{ $data['website'] }}

<strong>Message: </strong>

{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
