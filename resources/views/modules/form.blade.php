@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/modules" method="post">
        @csrf
        <h2>Ajouter un module</h2>
        <label for="formation_id">Formations</label>
        <p>
            <select name="formation_id" id="formation_id">
            <option value="">Sélectionnez une formation</option>
                @foreach($formations as $formation)
                <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                @endforeach
            </select>
        </p>
        @error('formation_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="{{ old('titre') }}">
        @error('titre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="{{ old('description') }}">
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- le champ ordre se gère dans la fonction store de ModuleResController -->
        <input type="submit">
    </form>

</div>


@endsection