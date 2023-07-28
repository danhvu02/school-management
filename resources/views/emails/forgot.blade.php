@component('mail::message')
Hello {{$user->name}},

<p>We understand it happens. </p>

@component('mail::button', ['url' => route('reset', $user->remember_token)])
Reset Your Password
@endcomponent

<p>In case you have any issues recovering your password, please contact us. </p>

Thanks,<br>
{{config('app.name') }}
@endcomponent
