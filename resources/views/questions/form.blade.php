@extends('layouts.default')

@section('content')

<div class="edit">

    <form action="/questions" method="post">
        @csrf
        <!-- Question -->
        <h3>Ajouter une question</h3>
        <label for="quiz_id">Sélectionnez un quiz</label>
        <select name="quiz_id" id="quiz_id">
        <option value=""></option>
            @foreach($quizzes as $quiz)
            <option {{ old('quiz_id') == $quiz->id ? "selected" : "" }} value="{{ $quiz->id }}">{{ $quiz->titre }}</option>
            @endforeach
        </select>
        @error('quiz_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="question">Ecrivez votre question</label>
        <p><input type="text" name="question" id="question" value="{{ old('question') }}"></p>
        @error('question')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="type">Type de question</label>
        <select name="type" id="type">
        <option value=""></option>
            <option value="{{ old('type') == 'checkbox' ? 'checkbox' : 'radio' }}">{{ old('type') == 'checkbox' ? 'Choix multiple' : 'Choix unique' }}</option>
            <option value="{{ old('type') == 'checkbox' ? 'radio' : 'checkbox' }}">{{ old('type') == 'checkbox' ? 'Choix unique' : 'Choix multiple' }}</option>
        </select>
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="ordre" id="ordre" value="{{ $questionsCount }}">

        <input type="submit">
    </form>

</div>


@endsection