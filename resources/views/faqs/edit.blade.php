@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/faqs/{{ $faq->id }}" method="post">
        @csrf
        @method('put')
        <h2>Modifier une question essentielle</h2>
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
        <label for="question">Question</label>
        <input type="text" name="question" id="question" value="{{ $faq->question }}">
        @error('question')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="reponse">Réponse</label>
        <!-- <input type="text" id="reponse" name="reponse" value="{{ $faq->reponse }}"> -->
        <textarea id="reponse" name="reponse">{{ $faq->reponse }}</textarea>
        @error('reponse')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit">
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