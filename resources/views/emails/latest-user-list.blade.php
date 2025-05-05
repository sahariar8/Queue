@component('mail::message')
# Introduction

Here are the latest 5 registered users:

@component('mail::table')
| Name | Email |
@foreach ($users as $user)
| {{ $user->name }} | {{ $user->email }} |
    
@endforeach

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
