@extends('layouts.nav')

@section('content')

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('password.update') }}" class="auth">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Address -->
    <label for="email" class="auth_label">Email</label>

    <x-input id="email" class="auth_input" type="email" name="email" :value="old('email', $request->email)" required autofocus />

    <!-- Password -->
    <label for="password" class="auth_label">{{ __('messages.mdp') }}</label>

    <x-input id="password" class="auth_input" type="password" name="password" required />

    <!-- Confirm Password -->
    <label for="password_confirmation" class="auth_label">{{ __('messages.mdpconfirm') }}</label>

    <x-input id="password_confirmation" class="auth_input" type="password" name="password_confirmation" required />

    <div class="auth_footer">
        <x-button>
            {{ __('messages.envoer') }}
        </x-button>
    </div>
</form>
@endsection