@extends('layouts.nav')

@section('content')

<div class="reset_mpd_titre">
    {{ __('messages.message_confirm') }}
</div>

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('password.confirm') }}" class="auth">
    @csrf

    <!-- Password -->

    <label for="password" class="auth_label">{{ __('messages.mdp') }}</label>

    <x-input id="password" class="auth_input" type="password" name="password" required autocomplete="current-password" />


    <div class="auth_footer">
        <x-button class="auth_footer_resetmdp">
            {{ __('messages.envoyer') }}
        </x-button>
    </div>
</form>
@endsection