@extends('emails.layout')
@section('content')
    <div class="custom-column custom-is-black custom-is-text-centered">
        <h1 class="custom-mb5">{{ config('app.name') }}</h1>
        <p class="custom-subtitle custom-mt5" >A request has been made to reset your password</p>
    </div>
    <div style="padding: 20px">
        <p style=" margin-bottom: 16px">You may reset your password by clicking the button below. If you need any assistance please feel free to reply to this email.</p>
        <div style="margin: 0 auto; text-align: center;">
            <p>
                <a class="custom-button" href="{{ config('app.client.web.urls.reset_password').$token }}" target="_blank">Reset Password</a>
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

        <p style="font-size: 14px"> {{ config('app.client.web.urls.reset_password').$token }} </p>
    </div>
@endsection