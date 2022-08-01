@extends('layouts.nav')

@section('content')

<div class="reset_mpd_titre">
    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
</div>

@if (session('status') == 'verification-link-sent')
<div class="reset_mpd_titre">
    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
</div>
@endif

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}" class="auth">
        @csrf

        <div class="auth_footer">
            <x-button>
                {{ __('Resend Verification Email') }}
            </x-button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="auth">
        @csrf

        <div class="auth_footer">
            <button type="submit">
                {{ __('Logout') }}
            </button>
        </div>
    </form>
</div>
@endsection