<tr>
    <td>
        {{$chapitre->titre}}
    </td>
    <td>
        {{mb_strimwidth($chapitre->description, 0, 100, '...')}}  
    </td>
    <td>
        {{$chapitre->module->titre}}
    </td>
    <td >
    <a href="/changeOrdreMChapitre?ordre={{$chapitre->ordre - 1}}&chapitre={{$chapitre->id}}&module={{$chapitre->module->id}}&operation=dec">
    <i class="fas fa-long-arrow-alt-up upArrow"></i></a>
        {{$chapitre->ordre}}
        <a href="/changeOrdreMChapitre?ordre={{$chapitre->ordre + 1}}&chapitre={{$chapitre->id}}&module={{$chapitre->module->id}}&operation=inc">
        <i class="fas fa-long-arrow-alt-down downArrow"></i></a>
    </td>

    @if(Auth::check())
    <td class="td_Button">
        <form action="/chapitres/{{ $chapitre->id }}" method="post">
            @csrf
             @method('delete')
            <input type="submit" value="Supprimer" name="delete" class="supp">
        </form>
    </td>
    <td class="td_Button">
        <form action="/chapitres/{{ $chapitre->id }}/edit" method="get">
            @csrf
            <input type="submit" value="Modifier" name="update" class="modif">
        </form>
    </td>
    @endif
</tr>