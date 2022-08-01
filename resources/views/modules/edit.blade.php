@extends('layouts.default')

@section('content')

<div class="edit">
    <form action="/modules/{{ $module->id }}" method="post">
        @csrf
        @method('put')
        <h2>Modifier un module</h2>
        <label for="formation_id">Sélectionnez une formation</label>
        <p>
            <select name="formation_id" id="formation_id">
                <option value="{{ $formation_old->id }}">{{ $formation_old->titre }}</option>
                @foreach($formations as $formation)
                @if ($formation->id !== $formation_old->id)
                <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                @endif
                @endforeach
            </select>
        </p>
        @error('formation_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="{{ $module->titre }}">
        @error('titre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="{{ $module->description }}">
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="ordre" value="{{ $module->ordre }}">
        <input type="submit">
    </form>

</div>


@endsection