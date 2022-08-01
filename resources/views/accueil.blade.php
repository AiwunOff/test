@extends('layouts.nav')

@section('content')

<div class="contenairAccueil">
    <div class="h1_accueil">
        <h1>{{ __('messages.mefh') }}</h1>
    </div>

    <!-- <img src="{{ asset('storage/images/construction.png') }}" style="position: absolute; top: 220px; left: 43%; width: 200px;"> -->


    <div class="blockTextAccueil">
        <h2 class="textAccueil1">
            {{ __('messages.slogan_accueil') }}
        </h2>
        <h2 class="textAccueil2">
            {{ __('messages.slogan_accueil2') }} <br>
            {{ __('messages.slogan_accueil3') }}
        </h2>

        <a id="lienFormation" href="formations-liste"><button id="buttonAccueil">{{ __('messages.button_accueil3') }}</button></a>
    </div>

    <!-- <img id="accueil9png" src="/storage/images/accueil9png.png" alt="égalité femmes hommes">
    <img id="accueil10png" src="/storage/images/accueil10png.png" alt="égalité femmes hommes"> -->

    <div class="sociaux">
        <a href="https://www.facebook.com/MEFH1/"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.linkedin.com/company/mouvement-%C3%A9galit%C3%A9-femmes-hommes/about/"><i class="fab fa-linkedin-in"></i></a>
        <a href="mailto:mouvementegalite.femmeshommes@gmail.com"><i class="fas fa-envelope"></i></a>
    </div>

</div>


<script src="/js/app.js"></script>
@endsection