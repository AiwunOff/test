<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class InfosUsersFormations implements FromCollection, WithHeadings
{

    protected $formation_id;
    protected $date;

    function __construct($formation_id, $date)
    {
        $this->formation_id = $formation_id;
        $this->date = $date;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $chapitres_suivis = DB::table('chapitre_suivis')
        ->select(
            'users.nom as user_name',
            'users.email as user_email',
            'chapitre_suivis.created_at as chapitres_suivis_date',
            'chapitres.titre as chapitre_titre',
            'chapitres.ordre as chapitre_ordre',
            'modules.titre as module_titre',
            'modules.ordre as module_ordre'
            
        )
        ->join('chapitres', 'chapitres.id', '=', 'chapitre_suivis.chapitre_id')
        ->join('users', 'users.id', '=', 'chapitre_suivis.user_id')
        ->join('modules', 'modules.id', '=', 'chapitres.module_id')
        ->join('formations', 'formations.id', '=', 'modules.formation_id')
        ->where('formation_id', $this->formation_id)
        ->where('chapitre_suivis.created_at', '>=', $this->date)
        ->orderBy('user_name', 'asc')
        ->orderBy('chapitres_suivis_date', 'asc')
        ->get();

        return $chapitres_suivis;
    }




    public function headings(): array
    {
        return ["Nom", "Email", "Date", "Chapitre", "OrdreChapitres", "Module", "OrdreModules"];
    }

}
