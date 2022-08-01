@extends('layouts.nav')

@section('content')



<div class="contenaire_profile">
    <div class="headerProfile">
        <h3 class="headerProfileH3First">{{ __('messages.inscrit_depuis') }} {{ date('d-m-Y', strtotime($user->created_at)) }}</h3>
        <button><a href="/edit-profile">{{ __('messages.completer_profile') }}</a></button>
    </div>

    <div class="headerProfile">
        <h3>{{ ucfirst(strtolower($user->nom)) }}</h3>
        <h3>{{ ucfirst(strtolower($user->prenom)) }}</h3>
    </div>

    <div class="headerProfile tabla_list_certificat">
        <h3>
            {{ __('messages.deja_reussi_quiz_suivants') }}
        </h3>
        <table class="table_certificat">
            <thead>
                <tr>
                    <th>{{ __('messages.formationsProfile') }}</th>
                    <th>{{ __('messages.modules') }}</th>
                    <th>{{ __('messages.scores') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($infos_quiz as $info_quiz)
                <tr>
                    <td>
                        {{$info_quiz->formation_titre}}
                    </td>
                    <td>
                        {{$info_quiz->module_titre}}
                    </td>
                    <td>
                        {{$info_quiz->score}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="headerProfile tabla_list_certificat">
        <h3>
            {{ __('messages.vos_certificats') }}
        </h3>
        <div class="certificatDownLoad">
            <table class="table_certificat">
                <thead>
                    <tr>
                        <th>{{ __('messages.formationsProfile') }} </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($infos_certificat as $info_certificat)
                    <tr>
                        <td>
                            {{$info_certificat->formation}}
                        </td>
                        <td>
                            {{ __('messages.telecharger_certificats') }}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/pdf?nom={{ ucfirst(strtolower($user->nom)) }}&prenom={{ ucfirst(strtolower($user->prenom)) }}&formation={{$info_certificat->formation}}&date={{$info_certificat->created_at}}&detail={{$info_certificat->detail}}"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

</div>


@endsection