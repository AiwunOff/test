<tr>
    <td>
        {!! $ressource->text !!}
    </td>
    <td>
        {{$ressource->formation->titre}}
    </td>

    @if(Auth::check())
    <td class="td_Button">
        <form action="/ressources/{{ $ressource->id }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Supprimer" name="delete" class="supp">
        </form>
    </td>
    <td class="td_Button">
        <form action="/ressources/{{ $ressource->id }}/edit" method="get">
            @csrf
            <input type="submit" value="Modifier" name="update" class="modif">
        </form>
    </td>
    @endif
</tr>