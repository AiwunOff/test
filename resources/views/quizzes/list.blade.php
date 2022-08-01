@extends('layouts.default')

@section('content')

<div class="contenaire_list">

    <h1 class="titre_list">Quiz</h1>

    <a href="{{ '/quizzes/create' }}">
        <button class="button_nouveau"><i class="fas fa-plus"></i>Ajouter un quiz</button>
    </a>


    <div class="tabla_list">

        <table>
            <thead>
                <tr>
                    <th>Tire</th>
                    <th>Module</th>
                    @if(Auth::check())
                    <th></th>
                    <th></th>
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @each('quizzes.one', $quizzes, 'quiz')

            </tbody>
        </table>
    </div>
</div>
@endsection