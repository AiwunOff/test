<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Certificat;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class CertificatController extends Controller
{
    public function createPdf(Request $request)
    {
        $nom = $request->nom;
        $prenom = $request->prenom;
        $formation = $request->formation;
        $detail = $request->detail;
        $date = date('d/m/Y', strtotime($request->date));
        $data = ['nom' => $nom, 'prenom' => $prenom, 'date' => $date, 'formation' => $formation, 'detail' => $detail];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('certificat', $data)->setPaper('a4', 'landscape');

        return $pdf->download('Certificat.pdf');
    }

}

    