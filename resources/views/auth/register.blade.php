@extends('layouts.nav')

@section('content')
<x-slot name="logo">
    <a href="/">
        <x-application-logo />
    </a>
</x-slot>

<!-- Validation Errors -->
<x-auth-validation-errors :errors="$errors" style="color:red;" />

<form method="POST" action="{{ route('register') }}" class="auth auth_inscription">
    @csrf

    <h1>{{ __('messages.inscription') }}</h1>
    <!-- Name -->
    <label for="nom" class="auth_label">{{ __('messages.nom') }}</label>

    <x-input id="nom" class="auth_input" type="text" name="nom" :value="old('nom')" required autofocus />


    <label for="prenom" class="auth_label">{{ __('messages.prenom') }}</label>

    <x-input id="prenom" class="auth_input" type="text" name="prenom" :value="old('prenom')" required autofocus />


    <label for="sexe" class="auth_label">{{ __('messages.sexe') }}</label>

    <select name="sexe" id="sexe" class="auth_input" required autofocus style="width:100%; border-radius: 0.375rem; border-color: rgba(209, 213, 219, 1);">
        <option value="old('sexe')"></option>
        <option value="Féminin">Féminin</option>
        <option value="Masculin">Masculin</option>
    </select>

    <!-- Email Address -->

    <label for="email" class="auth_label">Email</label>

    <x-input id="email" class="auth_input" type="email" name="email" :value="old('email')" required />

    <!-- Password -->

    <label for="password" class="auth_label">{{ __('messages.mdp') }}</label>

    <x-input id="password" class="auth_input" type="password" name="password" required autocomplete="new-password" />

    <!-- Confirm Password -->

    <label for="password_confirmation" class="auth_label">{{ __('messages.mdpconfirm') }}</label>

    <x-input id="password_confirmation" class="auth_input" type="password" name="password_confirmation" required />
    
    <div class="rgpd">
        <input type="checkbox" id="rgpd" name="rgpd" required>
        <label for="rgpd" id="label_rgpd">j’ai lu et j’accepte la politique de confidentialité du site m-egalitefemmeshommes.org</label>
    </div>

    <div class="g-recaptcha" data-sitekey="{{ config('captcha.v2-site') }}"></div>

    <div class="auth_footer">
        <a href="{{ route('login') }}">
            {{ __('messages.deja_inscrit') }}
        </a>

        <x-button>
            {{ __('messages.inscrire') }}
        </x-button>
    </div>




</form>
@endsection