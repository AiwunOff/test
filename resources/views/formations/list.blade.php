@extends('layouts.default')

@section('content')


<div class="contenaire_list">
    <h1 class="titre_list">Formations</h1>

    <a href="{{ '/formations/create' }}">
        <button class="button_nouveau"><i class="fas fa-plus"></i>Ajouter une formation</button>
    </a>

    <div class="tabla_list">

        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Langue</th>
                    <th>Ordre</th>
                    @if(Auth::check())
                    <th></th>
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @each('formations.one', $formations, 'formation')

            </tbody>
        </table>
    </div>
</div>

@endsection