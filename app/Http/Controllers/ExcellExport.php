<?php

namespace App\Http\Controllers;
    
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InfosUsersFormations;

class ExcellExport extends Controller
{
    public function storeExcel(Request $request) 
    {
        return Excel::download(new InfosUsersFormations($request->formation_id, $request->date), 'InfosUsersFormations.xls');
    }
}