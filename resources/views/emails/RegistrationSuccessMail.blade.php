@component('mail::message')
# Introduction
Hello {{ $name }},
Thank you for registering with us. We are excited to have you on board!
We will keep you updated with the latest news and updates.
## Your Details
- **Name:** {{ $name }}
- **Email:** {{ $email }}
- **Registration Date:** {{ now()->format('Y-m-d H:i:s') }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
