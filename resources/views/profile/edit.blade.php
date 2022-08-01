@extends('layouts.nav')

@section('content')

<div class="editCertificat">

    <form action="/profileUpadate" method="post" novalidate>
        @csrf
        <h2>Modifier un utilisateur</h2>
        <div class="editCertificatLeft">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ $user->nom }}">
            @error('nom')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" id="prenom" value="{{ $user->prenom }}">
            @error('prenom')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="sexe">Sexe</label>
            <select name="sexe" id="sexe">
                <option value="{{$user->sexe}}">{{$user->sexe}}</option>
                <option value="{{ $user->sexe === 'Masculin' ? 'Féminin' : 'Masculin' }}">{{ $user->sexe === 'Masculin' ? 'Féminin' : 'Masculin' }}</option>
            </select>
            @error('sexe')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="editCertificatRight">
            <label for="pays">Pays</label>
            <select name="pays" id="pays">
                <option value="{{ $user->pays }}">{{ $user->pays }}</option>
                @foreach($countries as $pays)
                <option value="{{ $pays->langFR }}">{{ $pays->langFR }}</option>
                @endforeach
            </select>
            @error('pays')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="ville">Code postal</label>
            <input type="number" name="ville" id="ville" value="{{ $user->ville }}">
            @error('ville')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="tranche_age">Dans quelles tranche d'age êtes vous ?</label>
            <select name="tranche_age" id="tranche_age">
                <option value="{{ $user->tranche_age }}">
                    @switch($user->tranche_age)
                    @case('moins de 25 ans')
                    moins de 25 ans
                    @break
                    @case('entre 25 et 35 ans')
                    entre 25 et 35 ans
                    @break
                    @case('entre 35 et 45 ans')
                    entre 35 et 45 ans
                    @break
                    @case('entre 45 et 55 ans')
                    entre 45 et 55 ans
                    @break
                    @case('entre 55 et 65 ans')
                    entre 55 et 65 ans
                    @break
                    @case('plus de 65 ans')
                    plus de 65 ans
                    @break
                    @default

                    @endswitch
                </option>
                <option value="moins de 25 ans">moins de 25 ans</option>
                <option value="entre 25 et 35 ans">entre 25 et 35 ans</option>
                <option value="entre 35 et 45 ans">entre 35 et 45 ans</option>
                <option value="entre 45 et 55 ans">entre 45 et 55 ans</option>
                <option value="entre 55 et 65 ans">entre 55 et 65 ans</option>
                <option value="plus de 65 ans">plus de 65 ans</option>
            </select>
            @error('tranche_age')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="hidden" name="id" value="{{ $user->id }}">
        </div>

        <div class="submitCertificat">
            <input type="submit">
            <a href="/profile"><button>Annuler</button></a>
        </div>

    </form>

</div>


@endsection