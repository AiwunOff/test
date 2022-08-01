<tr>
    <td>
        {{$module->titre}}
    </td>
    <td>
        {{mb_strimwidth($module->description, 0, 100, '...')}}
    </td>
    <td>
        {{$module->formation->titre}}
    </td>
    <td>
        <a href="/changeOrdreModule?ordre={{$module->ordre - 1}}&module={{$module->id}}&formation={{$module->formation->id}}&operation=dec">
            <i class="fas fa-long-arrow-alt-up upArrow"></i></a>
        {{$module->ordre}}
        <a href="/changeOrdreModule?ordre={{$module->ordre + 1}}&module={{$module->id}}&formation={{$module->formation->id}}&operation=inc">
            <i class="fas fa-long-arrow-alt-down downArrow"></i></a>
    </td>

    @if(Auth::check())
    <td class="td_Button">
        <form action="/modules/{{ $module->id }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Supprimer" name="delete" class="supp">
        </form>
    </td>
    <td class="td_Button">
        <form action="/modules/{{ $module->id }}/edit" method="get">
            @csrf
            <input type="submit" value="Modifier" name="update" class="modif">
        </form>
    </td>
    @endif
</tr>