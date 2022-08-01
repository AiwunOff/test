<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\module;
use App\Models\formation;
use App\Models\Ressource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Controllers\ModuleResController;
use App\Http\Controllers\RessourceController;
use App\Http\Requests\UpdateFormationRequest;
use Intervention\Image\ImageManagerStatic as Image;



class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = formation::orderBy('ordre', 'asc')
            ->get();

        return view('formations.list', ['formations' => $formations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langues = DB::table('langues')->get();
        return view('formations.form', ['langues' => $langues]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormationRequest $request)
    {
        $validated = $request->validated();

        $formation = new formation;
        $formation->titre = Arr::get($validated, 'titre');
        $formation->description = Arr::get($validated, 'description');
        $formation->langue = Arr::get($validated, 'langue');
        $formation->detail = Arr::get($validated, 'detail');
        $formationsCount = formation::all()->max('ordre') + 1;
        $formation->ordre = $formationsCount;
        if ($request->hasFile('image_formation')) {
            // si il y a un fichier image on le redimenssionne avec "intervention image" 
            // avant la sauvegarde
            $image = $request->file('image_formation');
            $filename = time() . $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(400, 250, function ($constraint) {
                $constraint->upsize();
            });
            $image_resize->save(storage_path('app/public/images/' . $filename));
            $formation->image_formation = 'images/' . $filename;
        }

        $formation->save();

        return redirect('formations');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show(formation $formation)
    {
        return $formation;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function edit(formation $formation)
    {
        $langues = DB::table('langues')->get();
        return view('formations.edit', ['formation' => $formation, 'langues' => $langues]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormationRequest $request, formation $formation)
    {
        $validated = $request->validated();

        //si il y a un fichier image alors on efface l'ancien
        // et on stock le nouveau
        if ($request->hasFile('image_formation')) {


            // code utilisé en production
            // if(!empty($formation->image_formation)) {
            //     unlink ('MEFH/storage/app/public/' . $formation->image_formation ) ;
            // } 

            Storage::delete('public/' . $formation->image_formation);
            // si il y a un fichier image on le redimenssionne avec "intervention image" 
            // avant la sauvegarde
            $image = $request->file('image_formation');
            $filename = time() . $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(400, 250, function ($constraint) {
                $constraint->upsize();
            });
            $image_resize->save(storage_path('app/public/images/' . $filename));
            $formation->image_formation = 'images/' . $filename;
        } else {
            $formation->image_formation = $formation->image_formation;
        }

        $formation->titre = Arr::get($validated, 'titre');
        $formation->description = Arr::get($validated, 'description');
        $formation->langue = Arr::get($validated, 'langue');
        $formation->detail = Arr::get($validated, 'detail');
        $formation->ordre = $formation->ordre;

        $formation->save();

        return redirect('formations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy(formation $formation)
    {
        // on récupère les modules de la formation pour les
        // supprimer
        $modulesToDelete = module::where('formation_id', $formation->id)
            ->get();

        $moduleController = new ModuleResController;

        foreach ($modulesToDelete as $module) {
            $moduleController->destroy($module);
        }

        // on récupère la faq de la formation pour la
        // supprimer
        $ressourceToDelete = Ressource::where('formation_id', $formation->id)
            ->get();

        $ressourceController = new RessourceController;

        foreach ($ressourceToDelete as $ressource) {
            $ressourceController->destroy($ressource);
        }

        // on récupère les ressources de la formation pour les
        // supprimer
        $faqToDelete = Faq::where('formation_id', $formation->id)
            ->get();

        $faqController = new FaqController;

        foreach ($faqToDelete as $faq) {
            $faqController->destroy($faq);
        }

        // code utilisé en production
        // if(!empty($formation->image_formation)) {
        // unlink ('MEFH/storage/app/public/' . $formation->image_formation ) ;
        // }

        Storage::delete('public/' . $formation->image_formation);
        $formation->delete();
        // réctifie si besoin les valeurs du champ ordre
        // pour garder la continuité et supprimer les trous
        $formations = formation::all();
        $i = 1;
        foreach ($formations  as $formation) {
            if ($formation !== $i) {
                $formation->ordre = $i;
                $formation->save();
                $i++;
            } else {
                $i++;
            }
        }
        return back();
    }

    // renvoi uniquement les formations dans la langue choisie
    public function formationsLangue(Request $request)
    {
        $langues = DB::table('formations')
            ->select('langue')
            ->distinct()
            ->orderBy('langue')
            ->get();


        if ($request->langue == 'Toutes les langues') {
            $formations = formation::all();
        } else {
            $formations =  formation::where('langue', '=', $request->langue)
                ->get();
        }

        return view('formations', [
            'formations' => $formations,
            'langue' => $request->langue,
            'langues' => $langues
        ]);
    }



    public function changeOrdre(Request $request)
    {
        $formationRemplace = formation::where('ordre', $request->ordre)
            ->first();

        $formation = formation::where('id', $request->formation)->first();

        $formationsCount = formation::all()->count();

        if ($request->operation == 'dec') {
            if ($request->ordre > 0) {
                $formationRemplace->ordre = $formation->ordre;
                $formationRemplace->save();
                $formation->ordre = $request->ordre;
                $formation->save();
                return redirect('/formations');
            }
        } else if ($request->operation == 'inc') {
            if ($request->ordre <= $formationsCount) {
                $formationRemplace->ordre = $formation->ordre;
                $formationRemplace->save();
                $formation->ordre = $request->ordre;
                $formation->save();
                return redirect('/formations');
            }
        }

        return redirect('/formations');
    }
}
