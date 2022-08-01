@extends('layouts.default')

@section('content')

<div class="contenaire_list">

    <h1 class="titre_list">Questions</h1>

    <a href="{{ '/questions/create' }}">
        <button class="button_nouveau"><i class="fas fa-plus"></i>Ajouter une question</button>
    </a>

    <form action="/questionsOneQuiz" method="post" class="contenaire_list_form">
        @csrf
        <p>
            <select name="quiz" class="contenaire_list_select" 
            onchange="this.form.submit()">
                <option value="all quizzes" hidden disabled selected>Sélectionnez un quiz</option>
                <option value="all quizzes">Sélectionner tous les quiz</option>
                @foreach($quizzes as $quiz)
                <option value="{{ $quiz->id }}">{{ $quiz->titre }}</option>
                @endforeach
            </select>
        </p>
    </form>

    <div class="tabla_list">

        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Type de question</th>
                    <th>Quiz</th>
                    @if(Auth::check())
                    <th></th>
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @each('questions.one', $questions, 'question')

            </tbody>
        </table>
    </div>
    @endsection