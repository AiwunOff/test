@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/users" method="post" novalidate>
        @csrf
        <h2>Ajouter un utilisateur</h2>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom') }}">
        @error('nom')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}">
        @error('prenom')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="sexe">Sexe</label>
        <select name="sexe" id="sexe">
            <option value=""></option>
            <option value="Masculin">Masculin</option>
            <option value="Feminin">Feminin</option>
        </select>
        @error('sexe')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="admin">Administrateur</label>
        <select name="admin" id="admin">
            <option value=""></option>
            <option value="1">admin</option>
            <option value="0">not admin</option>
        </select>
        @error('admin')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit" value="Ajouter">
    </form>

</div>


@endsection