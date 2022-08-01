@extends('layouts.default')

@section('content')

<div class="contenaire_list">

    <h1 class="titre_list">Questions essentielles</h1>

    <a href="{{ '/faqs/create' }}">
        <button class="button_nouveau"><i class="fas fa-plus"></i>Ajouter une question essentielle</button>
    </a>


    <form action="/faqsOneFormation" method="post" class="contenaire_list_form">
        @csrf
        <p>
            <select name="formation" class="contenaire_list_select" 
            onchange="this.form.submit()">
                <option value="all formations" hidden disabled selected>Sélectionnez une formation</option>
                <option value="all formations">Sélectionner toutes les formations</option>
                @foreach($formations as $formation)
                <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                @endforeach
            </select>
        </p>
    </form>

    <div class="tabla_list">

        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Réponse</th>
                    <th>Formation</th>
                    @if(Auth::check())
                    <th></th>
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @each('faqs.one', $faqs, 'faq')

            </tbody>
        </table>
    </div>
</div>
@endsection