@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/users/{{ $user->id }}" method="post" novalidate>
        @csrf
        @method('put')
        <h2>Modifier un utilisateur</h2>
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
        <label for="admin">Admin</label>
        <select name="admin" id="admin">
            <option value="{{ $user->admin }}">{{ $user->admin === '1' ? 'admin' : 'not admin' }}</option>
            <option value="{{ $user->admin === '1' ? '0' : '1' }}">{{ $user->admin === '1' ? 'not admin' : 'admin' }}</option>
        </select>
        @error('admin')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}">
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="{{ $user->password }}">
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit">
    </form>

</div>


@endsection
