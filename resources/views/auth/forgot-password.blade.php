@extends('layouts.nav')

@section('content')

<div class="reset_mpd_titre">
    <h1>{{ __('messages.reset_mdp_titre') }}</h1>
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('password.email') }}" class="auth auth_resetmdp">
    @csrf
    <!-- <div class="auth_logo">
        <a href="/"><img src="/storage/images/mefhlogo.png" width="100px" alt="logo" /></a>
    </div> -->
    <!-- Email Address -->
    <label for="email" class="auth_label">Email</label>

    <x-input id="email" class="auth_input" type="email" name="email" :value="old('email')" required autofocus />

    <div class="auth_footer">
        <x-button class="auth_footer_resetmdp">
            {{ __('messages.resetmdp') }}
        </x-button>
    </div>
</form>
@endsection