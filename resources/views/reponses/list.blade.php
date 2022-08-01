@extends('layouts.default')

@section('content')

<div class="contenaire_list">

    <h1 class="titre_list">Réponses</h1>

    <a href="{{ '/reponses/create' }}">
        <button class="button_nouveau"><i class="fas fa-plus"></i>Ajouter une réponse</button>
    </a>

    <form action="/reponsesOneQuestion" method="post" class="contenaire_list_form">
        @csrf
        <p>
            <select name="question" class="contenaire_list_select" onchange="this.form.submit()">
                <option value="all questions" hidden disabled selected>Sélectionnez une question</option>
                <option value="all questions">Sélectionner toutes les questions</option>
                @foreach($questions as $question)
                <option value="{{ $question->id }}">{{ $question->question }}</option>
                @endforeach
            </select>
        </p>
    </form>


    <div class="tabla_list">

        <table>
            <thead>
                <tr>
                    <th>Réponse</th>
                    <th>Is_correct</th>
                    <th>Question</th>
                    @if(Auth::check())
                    <th></th>
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @each('reponses.one', $reponses, 'reponse')

            </tbody>
        </table>
    </div>
</div>
@endsection