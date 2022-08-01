<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Ressource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ReactRequestController extends Controller
{
    // renvoi la ressource et/ou la faq d'une formation donnée
    // s'il y en a. Sinon renvoi hide pour cacher les liens où il n'y a rien
    // dans la page de formation
    public function getLiens($idFormation)
    {
       
        $langue = LaravelLocalization::localizeUrl('(/getLiens)');

        if (str_contains($langue, '/nl/')) {
            $langue = 'nl';
        } else if (str_contains($langue, '/en/')) {
            $langue = 'en';
        } else {
            $langue = 'fr';
        }


        $liens = Array( ["ressource" => "", "faq" => "", "langue" => ""] );

        $ressource = Ressource::where('formation_id', '=', $idFormation)
            ->get();

        if ($ressource->isEmpty()) {
            $liens["ressource"] = 'hide';
        } else {
            $liens["ressource"] = $ressource;
        }

        $faq = Faq::where('formation_id', '=', $idFormation)
            ->get();

        if ($faq->isEmpty()) {
            $liens["faq"] = 'hide';
        } else {
            $liens["faq"] = $faq;
        }

        $liens["langue"] = $langue;
    
        return $liens;


    }
}
