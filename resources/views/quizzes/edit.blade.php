@extends('layouts.default')

@section('content')

<div class="editQuiz">

    <form action="/quizzes/{{ $quiz->id }}" method="post">
        @csrf
        @method('put')
        <h2>Modifier un quiz</h2>
        <h4>Quiz : {{ $quiz->titre }}</h4>
        <label for="titre">Modifier le titre</label>
        <input type="text" name="titre" id="titre" value="{{ $quiz->titre }}">
        @error('titre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
        <br>
        <input type="submit" value="Confirmer">
    </form>


    @foreach($quiz->questions as $question)
    <div class="formQuiz">
        <h3>{{ $question->question }}</h3>
        <form action="/questions/{{ $question->id }}" method="post" class="endRight">
            @csrf
            @method('delete')
            <input type="submit" value="Supprimer" name="delete" class="suppQuiz">
        </form>
    </div>
    @foreach($question->reponses as $reponse)
    <div class="formQuiz">
        <!-- permet d'ajouter un chiffre différent à la fin du name pour différencier les checkbox
            et permettre d'envoyer plusieurs réponses pour une même question -->
        <div style="display: none;">{{ $name = $question->type == 'radio' ? '' : '_' . $loop->index }}</div>
        <input type="{{ $question->type }}" name="{{ $reponse->question_id . $name }}" id="{{ $reponse->id }}" value="{{ $reponse->id }}">
        <label for="{{ $reponse->id }}">{{ $reponse->reponse }}</label>
        <form action="/reponses/{{ $reponse->id }}" method="post" class="endRight">
            @csrf
            @method('delete')
            <input type="submit" value="Supprimer" name="delete" class="suppQuiz">
        </form>
    </div>
    @endforeach
    @endforeach



</div>


@endsection