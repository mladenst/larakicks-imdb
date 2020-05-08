@extends('emails.layout')
@section('content')
    <div class="custom-column custom-is-black custom-is-text-centered">
        <h1 class="custom-mb5">{{ config('app.name') }}</h1>
        <p class="custom-subtitle custom-mt5">Email confirmation</p>
    </div>
    <div style="padding: 20px">
        <p class="custom-h3 custom-is-text-centered" >Thank you for registering on {{ config('app.name') }} application!</p>
        <p style=" margin-bottom: 16px">To confirm your email address please click the button below, or if you have any questions, please let us know by replying to this email. </p>
        <div style="margin: 0 auto; text-align: center;">
            <p>
                <a class="custom-button" href="{{ config('app.client.web.urls.confirm_email').$confirmation_code }}" target="_blank">Confirm Email</a>
            </p>
        </div>
        <div>
            <h5>Best regards,</h5>
            <h5 style="margin-top: 5px;">{{ config('app.name') }} Team</h5>
        </div>
    </div>
    <hr>
    <div style="padding: 20px">
        <p style="font-size: 12px"> If you can't click on that button, just copy and paste following url in your browser's address bar: </p>

        <p style="font-size: 14px"> {{ config('app.client.web.urls.confirm_email').$confirmation_code }} </p>
    </div>
@endsection