@extends('layouts.default')

@section('content')

<div class="edit">

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/chapitres/{{ $chapitre->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h2>Modifier un chapitre</h2>
        <label for="module_id">Module</label>
        <select name="module_id" id="module_id">
            <option value="{{ $chapitre->module_id }}">{{ $chapitre->module->titre }}</option>
            @foreach($modules as $module)
            <option value="{{ $module->id }}">{{ $module->titre }}</option>
            @endforeach
        </select>
        @error('module_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="{{ $chapitre->titre }}">
        @error('titre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="fichier_video">Fichier video</label>
        <input type="file" id="fichier_video" name="fichier_video" accept="video/*">
        @error('fichier_video')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="sous_titres">Fichier sous-titres</label>
        <input type="file" id="sous_titres" name="sous_titres" accept=".vtt, VTT, Vtt">

        <label for="description">Description</label>
        <textarea id="description" name="description">{{ $chapitre->description }}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="ordre" id="ordre" value="{{ $chapitre->ordre }}">

        <input type="submit">
    </form>

</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>

@endsection