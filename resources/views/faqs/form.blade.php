@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/faqs" method="post">
        @csrf
        <h2>Ajouter une question essentielle</h2>
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
        <label for="question">Question</label>
        <input type="text" name="question" id="question" value="{{ old('question') }}">
        @error('question')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="reponse">Reponse</label>
        <textarea id="reponse" name="reponse">{{ old('reponse') }}</textarea>
        @error('reponse')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit" value="envoyer">
    </form>

</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
CKEDITOR.replace( 'reponse', {
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
</script>

@endsection