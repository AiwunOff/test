<tr>
    <td>
        {{$user->nom}}
    </td>
    <td>
        {{$user->prenom}}
    </td>
    <td>
        {{$user->sexe}}
    </td>
    <td>
        {{$user->admin}}
    </td>
    <td>
        {{$user->email}}
    </td>


    @if(Auth::check())
    <td class="td_Button">
        <form action="/users/{{ $user->id }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Supprimer" name="delete" class="supp">
        </form>
    </td>
    <td class="td_Button"> 
        <form action="/users/{{ $user->id }}/edit" method="get">
            @csrf
            <input type="submit" value="Modifier" name="update" class="modif">
        </form>
    </td>
    @endif
</tr>