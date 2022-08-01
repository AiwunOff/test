@extends('layouts.nav')

@section('content')

<!-- Session Status -->
<x-auth-session-status :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors :errors="$errors" />

<form method="POST" action="{{ route('login') }}" class="auth">
    @csrf

    <h1>{{ __('messages.connexion') }}</h1>
    <!-- Email Address -->

    <x-label for="email" :value="__('Email')" class="auth_label" />

    <x-input id="email" class="auth_input" type="email" name="email" :value="old('email')" required autofocus />


    <!-- Password -->

    <label for="password" class="auth_label">{{ __('messages.mdp') }}</label>

    <x-input id="password" class="auth_input" type="password" name="password" required autocomplete="current-password" />


    <!-- Remember Me -->

    <div class="auth_remember">
        <input id="remember_me" type="checkbox" class="auth_checkbox" name="remember">
        <span>{{ __('messages.se_souvenir_de_moi') }}</span>
    </div>


    <div class="auth_footer">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">
            {{ __('messages.mdp_oublie') }}
        </a>
        @endif

        <x-button>
            {{ __('messages.connexion') }}
        </x-button>
    </div>
    </br>
    <div class="rgpd">
        <a href="{{ '/register' }}">New user? Click here to sign up</a>
    </div>
</form>
@endsection