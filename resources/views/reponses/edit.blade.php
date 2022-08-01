@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/reponses/{{ $reponse->id }}" method="post">
        @csrf
        @method('put')
        <h2>Modifier une réponse</h2>
        <label for="question_id">Chousissez une question</label>
        <select name="question_id" id="question_id">
            <option value="{{ $reponse->question_id }}">{{ $reponse->question->question }}</option>
            @foreach($questions as $question)
            <option value="{{ $question->id }}">{{ $question->question }}</option>
            @endforeach
        </select>
        @error('question_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="reponse">Ecrivez votre réponse</label>
        <input type="text" name="reponse" id="reponse" value="{{ $reponse->reponse }}">
        @error('reponse')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="is_correct">Indiquez si la réponse est correcte</label>
        <select name="is_correct" id="is_correct">
            <option value="{{ $reponse->is_correct === 1 ? 1 : 0 }}">{{ $reponse->is_correct === 1 ? 'Correcte' : 'Pas correcte' }}</option>
            <option value="{{ $reponse->is_correct === 1 ? 0 : 1 }}">{{ $reponse->is_correct === 1 ? 'Pas correcte' : 'Correcte' }}</option>
        </select>
        @error('is_correct')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit">
    </form>

</div>


@endsection