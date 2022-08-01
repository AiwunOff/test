@extends('layouts.default')

@section('content')

<div class="contenaire_list">

    <h1 class="titre_list">Modules</h1>

    <a href="{{ '/modules/create' }}">
        <button class="button_nouveau"><i class="fas fa-plus"></i>Ajouter un module</button>
    </a>

    <form action="/modulesOneFormation" method="post" class="contenaire_list_form">
        @csrf
        <p>
            <select name="formation" class="contenaire_list_select" onchange="this.form.submit()">
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
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Formation</th>
                    <th>Ordre</th>
                    @if(Auth::check())
                    <th></th>
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @each('modules.one', $modules, 'module')

            </tbody>
        </table>
    </div>
</div>
@endsection