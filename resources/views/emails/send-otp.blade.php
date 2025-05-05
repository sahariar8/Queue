@component('mail::message')
# Introduction
<p>Dear User,</p>
<p>Your OTP - {{ rand(1000,9999) }}</p>
<p>Dont Share Your OTP</p>
<br>

<p>Thank You</p>
{{ config('app.name') }}
@endcomponent
