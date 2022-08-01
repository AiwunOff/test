@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/ressources" method="post">
        @csrf
        <h2>Ajouter une ressource</h2>
        <label for="formation_id">Sélectionnez une formation</label>
        <p>
            <select name="formation_id" id="formation_id">
            <option value=""></option>
                @foreach($formations as $formation)
                <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                @endforeach
            </select>
        </p>
        @error('formation_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="text">Texte de la ressource</label>
        <textarea id="text" name="text">{{ old('text') }}</textarea>
        @error('text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit" value="envoyer">
    </form>

</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
CKEDITOR.replace( 'text', {
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
</script>

@endsection