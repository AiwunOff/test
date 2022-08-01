@extends('layouts.nav')

@section('content')


<div class="topContainerFormationList">
    <div class="contenaire_text-formation">
        <div class="text-formation">
            <h1>{{ __('messages.slogan1_formations') }}</h1>
            <p>{{ __('messages.slogan2_formations') }}</p>
        </div>
    </div>
    
    <div class="contenaireFormations">
        <div class="selectForm">
            <form action="/formationsLangue" method="get">
       
                <select name="langue" id="langue" onchange="this.form.submit()">
                <option value="" disabled selected>{{ __('messages.choisissez_une_langue') }}</option>
                    <!-- @isset( $langue ) <option value="{{ $langue }}">{{ $langue }}</option> @endisset -->
                    @if ($langue && $langue !== 'Toutes les langues')
                    <option value="Toutes les langues">{{ __('messages.toutes_les_langues') }}</option>
                    @endif
                    @foreach($langues as $langue)
                    <option value="{{ $langue->langue }}">{{ $langue->langue }}</option>
                    @endforeach
    
                </select>
            </form>
        </div>
    
    
        <div class="blockFormations">
            @foreach ($formations as $formation)
            <a href="formation/{{ $formation->id }}" class="card-formation">
                <div class="supp-card-formation">
                    <h2>{{ $formation->titre }}</h2>
                </div>
    
                <figure class="fig_formations_liste">
                    <img class="img_formation" src="{{ asset('storage/'.$formation->image_formation) }}" alt="illustrations formations" />
                </figure>
    
                <div class="inf-card-formation">
                    <h3>{{ $formation->description }}</h3>
                </div>
                <div class="inf-card-langue">
                    <h4><strong>Langue : &nbsp;</strong>{{ $formation->langue }}</h4>
                </div>
    
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection