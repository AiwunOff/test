<?php

namespace App\Http\Controllers;

use App\Models\module;
use App\Models\chapitre;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Chapitre_suivi;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateChapitreRequest;
use App\Http\Requests\StorePostChapitreRequest;

class ChapitreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = module::all();
        $chapitres = chapitre::orderBy('module_id', 'asc')
            ->orderBy('ordre', 'asc')
            ->get();
        return view('chapitres.list', ['chapitres' => $chapitres, 'modules' => $modules]);
    }

    public function indexSelect(Request $request)
    {

        $modules = module::all();
        if ($request->module == 'all modules') {
            $chapitres = chapitre::orderBy('module_id', 'asc')
                ->orderBy('ordre', 'asc')
                ->get();
        } else {
            $chapitres =  chapitre::where('module_id', '=', $request->module)
                ->orderBy('ordre', 'asc')
                ->get();
        }
        return view('chapitres.list', ['chapitres' => $chapitres, 'modules' => $modules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $modules = module::all();
        return view('chapitres.form', ['modules' => $modules]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostChapitreRequest $request)
    {
        $validated = $request->validated();

        $chapitre = new chapitre;
        $chapitre->titre = Arr::get($validated, 'titre');
        $chapitre->description = Arr::get($validated, 'description');
        //$chapitre->iframe_video = Arr::get($validated, 'iframe_video');
        $chapitre->ordre = chapitre::where('module_id', $validated['module_id'])->max('ordre') + 1;
        $chapitre->module_id = Arr::get($validated, 'module_id');
        if ($request->hasFile('fichier_video')) {
            $chapitre->fichier_video = $request->fichier_video->store('fichier_video', 'public');
        }
        if ($request->hasFile('sous_titres')) {
            $chapitre->sous_titres = $request->sous_titres->store('fichier_video', 'public');
        }
        $chapitre->save();

         return redirect('chapitres');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chapitre  $chapitre
     * @return \Illuminate\Http\Response
     */
    public function show(chapitre $chapitre)
    {
        return $chapitre;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chapitre  $chapitre
     * @return \Illuminate\Http\Chapitre
     */
    public function edit(Chapitre $chapitre)
    {
        $modules = module::all();

        return view('chapitres.edit', [
            'chapitre' => $chapitre,
            'modules' => $modules
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chapitre  $chapitre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChapitreRequest $request, chapitre $chapitre)
    {

        $validated = $request->validated();
        
        //si fichier vidéo ou sous-titres alors on efface les anciens
        
        //if ($request->hasFile('fichier_video')) {
        //    unlink ( 'MEFH/storage/app/public/' . $chapitre->fichier_video ) ;
        //} else {
        //    $chapitre->fichier_video = $chapitre->fichier_video;
        //}
    
        if ($request->hasFile('fichier_video')) {

            if (Storage::disk('public')->exists($chapitre->fichier_video)) {
                Storage::delete('MEFH/storage/app/public/' . $chapitre->fichier_video);
            }
        } else {
            $chapitre->fichier_video = $chapitre->fichier_video;
        }
        
        if ($request->hasFile('sous_titres')) {

            if (Storage::disk('public')->exists($chapitre->sous_titres)) {
                Storage::delete('MEFH/storage/app/public/' . $chapitre->sous_titres);
            }
        } else {
            $chapitre->sous_titres = $chapitre->sous_titres;
        }
        
        
        //if ($request->hasFile('sous_titres')) {
        //    unlink ( 'MEFH/storage/app/public/' . $chapitre->sous_titres ) ;
        //} else {
        //    $chapitre->sous_titres = $chapitre->sous_titres;
        //}
         
         

        //$validate est un tableau d'où on récupère chaque champ validé
        $chapitre->titre = Arr::get($validated, 'titre');
        $chapitre->description = Arr::get($validated, 'description');
        $chapitre->ordre = $chapitre->ordre;
        $chapitre->module_id = Arr::get($validated, 'module_id');

        // si il y a un fichier vidéo alors on le stock dans storage et on 
        //récupère son chemin idem pour sous_titres
        if ($request->hasFile('fichier_video')) {
            $chapitre->fichier_video = $request->fichier_video->store('fichier_video', 'public');
        }
        if ($request->hasFile('sous_titres')) {
            $chapitre->sous_titres = $request->sous_titres->store('fichier_video', 'public');
        }

        $chapitre->save();

        return redirect('chapitres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chapitre  $chapitre
     * @return \Illuminate\Http\Response
     */
    public function destroy(chapitre $chapitre)
    {
        $moduleId = $chapitre->module_id;

         if(!empty($chapitre->fichier_video)) {
             //unlink ( 'MEFH/storage/app/public/' . $chapitre->fichier_video ) ;
             Storage::delete('public/' . $chapitre->fichier_video);
         } 
         if(!empty($chapitre->sous_titres)) {
             //unlink ( 'MEFH/storage/app/public/' . $chapitre->sous_titres ) ;
             Storage::delete('public/' . $chapitre->sous_titres);
         }

        
        $chapitre->delete();

        // pour les chapitres d'un module donné
        // réctifie si besoin les valeurs de ordre
        // pour garder la continuité et supprimer les trous
        $chapitres = chapitre::where('module_id', $moduleId)
            ->orderBy('ordre', 'asc')
            ->get();

        $i = 1;
        foreach ($chapitres  as $chapitre) {
            if ($chapitre !== $i) {
                $chapitre->ordre = $i;
                $chapitre->save();
                $i++;
            } else {
                $i++;
            }
        }

        return redirect('chapitres');
    }


    // public function deleteAll(Request $request)
    // {
        
    //     $chapitre = Chapitre::find($request->chapitreId);

    //     // dd($chapitre);


    //     Storage::delete('public/' . $request->fichier_video);
    //     // Storage::delete('public/' . $request->sous_titres);
    //     $chapitre->delete();

    //     // pour les chapitres d'un module donné
    //     // réctifie si besoin les valeurs de ordre
    //     // pour garder la continuité et supprimer les trous
    //     $chapitres = chapitre::where('module_id', $chapitre->module_id)
    //         ->orderBy('ordre', 'asc')
    //         ->get();

    //     $i = 1;
    //     foreach ($chapitres  as $chapitre) {
    //         if ($chapitre !== $i) {
    //             $chapitre->ordre = $i;
    //             $chapitre->save();
    //             $i++;
    //         } else {
    //             $i++;
    //         }
    //     }

    //     return redirect('chapitres');
    // }

    // enregistre dans chapitreSuivis les chapitre_id 
    // que l'utilisateur veut marquer comme déjà suivis
    // ou bien les supprime quand il veut les remettre
    // en pas encore suivi
    public function suivi(Request $request)
    {

        $chapitreSuivi = Chapitre_suivi::where('chapitre_id', $request->chapitre_id)
            ->where('user_id', $request->id)
            ->first();

        if (!$chapitreSuivi) {
            $chapitreSuivi = new Chapitre_suivi;
            $chapitreSuivi->chapitre_id = $request->chapitre_id;
            $chapitreSuivi->user_id = $request->id;

            $chapitreSuivi->save();
        } else {
            $chapitreSuivi->delete();
        }
        return json_encode('chapitreSuivi success  ' . $chapitreSuivi);
    }


    // renvoi la liste des chapitres marqués comme déjà suivis
    public function list(Request $request)
    {

        $list =  Chapitre_suivi::where('user_id', $request->id)
            ->get();

        return $list;
    }



    public function changeOrdre(Request $request)
    {
        $chapitreRemplace = chapitre::where('module_id', $request->module)
            ->where('ordre', $request->ordre)
            ->first();

        $chapitre = chapitre::where('id', $request->chapitre)->first();

        $chapitresCount = chapitre::where('module_id', $request->module)->max('ordre');

        // dd($chapitre, $chapitreRemplace, $chapitresCount);

        if ($request->operation == 'dec') {
            if ($request->ordre > 0) {
                $chapitreRemplace->ordre = $chapitre->ordre;
                $chapitreRemplace->save();
                $chapitre->ordre = $request->ordre;
                $chapitre->save();
                return redirect('/chapitres');
            }
        } else if ($request->operation == 'inc') {
            if ($request->ordre <= $chapitresCount) {
                $chapitreRemplace->ordre = $chapitre->ordre;
                $chapitreRemplace->save();
                $chapitre->ordre = $request->ordre;
                $chapitre->save();
                return redirect('/chapitres');
            }
        }

        return redirect('/chapitres');
    }
}
