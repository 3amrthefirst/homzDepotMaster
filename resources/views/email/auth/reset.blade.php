@component('mail::message')
There was recently a request to change the password for your account.

{{ config('app.name') }}  Reset Password .

Rest password code . <b>{{$code}}</b>.
<br>
If you did not make this request, you can ignore this email and your password will remain the same.
Thanks,<br>
{{ config('app.name') }}
@endcomponent
