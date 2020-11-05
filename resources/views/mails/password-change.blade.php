@component('mail::message')
# Password Change Confirmation

Your password has been changed!

If you has not changed the password yourself then click the button below to reset your password
@component('mail::button', ['url' => 'http://localhost:8000/password/reset'])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent