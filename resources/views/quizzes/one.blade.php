<tr>
    <td>
        {{$quiz->titre}}
    </td>
    <td>
        {{$quiz->module->titre}}
    </td>

    @if(Auth::check())
    <td class="td_Button">
        <form action="/quizzes/{{ $quiz->id }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Supprimer" name="delete" class="supp">
        </form>
    </td>
    <td class="td_Button">
        <form action="/quizzes/{{ $quiz->id }}/edit" method="get">
            @csrf
            <input type="submit" value="Modifier" name="update" class="modif">
        </form>
    </td>
    @endif
    
    @foreach($quiz->users as $user)
    <td>{{ $user->nom }}</td>
    @endforeach
</tr>