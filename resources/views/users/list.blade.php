@extends('layouts.default')

@section('content')

<div class="contenaire_list">

    <h1 class="titre_list">Utilisateurs</h1>

    <a href="{{ '/users/create' }}">
        <button class="button_nouveau"><i class="fas fa-plus"></i>Ajouter un utilisateur</button>
    </a>


    <div class="tabla_list">

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Admin</th>
                    <th>Email</th>
                    @if(Auth::check())
                    <th></th>
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @each('users.one', $users, 'user')

            </tbody>
        </table>
    </div>
</div>
@endsection