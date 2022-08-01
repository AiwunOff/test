@extends('layouts.default')

@section('content')

<div class="edit">
<form action="/formations/{{ $formation->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h2>Modifier une formation</h2>
        <label for="titre">Titre  (100 caractères maximum)</label>
        <input type="text" name="titre" id="titre" value="{{ $formation->titre }}">
        @error('titre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="description">Description  (100 caractères maximum)</label>
        <input type="text" name="description" id="description" value="{{ $formation->description }}">
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="langue">Langue</label>
        <select name="langue" id="langue">
            <option value="{{ $formation->langue }}">{{ $formation->langue }}</option>
            @foreach($langues as $langue)
            <option value="{{ $langue->langue }}">{{ $langue->langue }}</option>
            @endforeach
        </select>
        @error('langue')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="image_formation">Choisissez une image si vous souhaitez remplacer l'image actuelle</label>
        <input type="file" name="image_formation" id="image_formation">
        @error('image_formation')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="detail">Détails certificat</label>
        <textarea id="detail" name="detail" rows="10" cols="80">{{ $formation->detail }}</textarea>
        @error('detail')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <input type="hidden" name="ordre" value="{{ $formation->ordre }}">
        <input type="submit">
    </form>

</div>


@endsection