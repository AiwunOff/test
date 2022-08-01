@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/reponses" method="post">
        @csrf
        <h2>Ajouter une réponse</h2>
        <label for="question_id">Chousissez une question</label>
        <select name="question_id" id="question_id">
            <option value=""></option>
            @foreach($questions as $question)
            <option value="{{ $question->id }}">{{ $question->question }}</option>
            @endforeach
        </select>
        @error('question_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="reponse">Indiquez une réponse</label>
        <input type="text" name="reponse" id="reponse" value="{{ old('reponse') }}">
        @error('reponse')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="is_correct">Indiquez si la réponse est correcte</label>
        <select name="is_correct" id="is_correct">
            <option value=""></option>
            <option value="1">correcte</option>
            <option value="0">pas correcte</option>
        </select>
        @error('is_correct')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit">
    </form>

</div>


@endsection