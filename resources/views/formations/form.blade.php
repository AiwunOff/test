@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/formations" method="post" enctype="multipart/form-data">
        @csrf
        <h2>Ajouter une formation</h2>
        <label for="titre">Titre (100 caractères maximum)</label>
        <input type="text" name="titre" id="titre" value="{{ old('titre') }}">
        @error('titre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="description">Description (100 caractères maximum)</label>
        <input type="text" name="description" id="description" value="{{ old('description') }}">
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="langue">Langue</label>
        <select name="langue" id="langue">
            <option value=""></option>
            @foreach($langues as $langue)
            <option value="{{ $langue->langue }}">{{ $langue->langue }}</option>
            @endforeach
        </select>
        @error('langue')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="image_formation">Image</label>
        <input type="file" name="image_formation" id="image_formation">
        @error('image_formation')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="detail">Détails certificat</label>
        <textarea   id="detail" name="detail" value="{{ old('detail') }}" rows="10" cols="80"></textarea>
        @error('detail')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit">
    </form>

</div>

<!-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
CKEDITOR.replace( 'detail', {
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
</script> -->
@endsection