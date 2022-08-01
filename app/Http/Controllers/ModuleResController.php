<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use App\Models\module;
use App\Models\chapitre;
use App\Models\formation;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\QuizController;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Controllers\ChapitreController;

class ModuleResController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = formation::all();
        $modules = module::orderBy('formation_id', 'asc')
            ->orderBy('ordre', 'asc')
            ->get();
        return view('modules.list', ['modules' => $modules, 'formations' => $formations]);
    }

    public function indexSelect(Request $request)
    {

        $formations = formation::all();
        if ($request->formation == 'all formations') {
            $modules = module::orderBy('formation_id', 'asc')
                ->orderBy('ordre', 'asc')
                ->get();
        } else {
            $modules =  module::where('formation_id', '=', $request->formation)
                ->orderBy('ordre', 'asc')
                ->get();
        }
        return view('modules.list', ['modules' => $modules, 'formations' => $formations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formations = formation::all();
        return view('modules.form', ['formations' => $formations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModuleRequest $request)
    {
        $validated = $request->validated();


        $module = new module;
        $module->titre = Arr::get($validated, 'titre');
        $module->description = Arr::get($validated, 'description');

        $module->formation_id = Arr::get($validated, 'formation_id');
        $modulesCount = module::where('formation_id', $validated['formation_id'])->max('ordre') + 1;
        $module->ordre = $modulesCount;
        $module->save();

        return redirect('/modules');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    // public function show(Module $module)
    // {
    //     return view('modules.one', ['module' => $module]);
    // }


    public function show($id)
    {

        // renvoi tous les chapitres correspondants aux modules
        // d'une formation donnée
        return DB::table('modules')
            ->select(
                'modules.id as module_id',
                'modules.ordre as module_ordre',
                'chapitres.id as id',
                'modules.titre as module_titre',
                'modules.description as module_description',
                'chapitres.titre as titre',
                'chapitres.description as description',
                'fichier_video',
                'chapitres.ordre as ordre',
                'modules.formation_id as formation_id',
                'quizzes.module_id as quiz_module_id',
                'sous_titres',
            )
            ->join('chapitres', 'modules.id', '=', 'chapitres.module_id')
            ->leftJoin('quizzes', 'modules.id', '=', 'quizzes.module_id')
            ->where('formation_id', $id)
            ->orderBy('module_ordre', 'asc')
            ->orderBy('ordre', 'asc')
            ->get();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(module $module)
    {
        $formation = formation::find($module->formation_id);
        $formations = formation::all();
        return view('modules.edit', [
            'module' => $module,
            'formation_old' => $formation,
            'formations' => $formations
        ]);
    }

    /**
     * Update the specified resource in storage.F
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(StoreModuleRequest $request, module $module)
    {
        $validated = $request->validated();

        $module->titre = Arr::get($validated, 'titre');
        $module->description = Arr::get($validated, 'description');
        $module->ordre = $module->ordre;
        $module->formation_id = Arr::get($validated, 'formation_id');

        $module->save();

        return redirect('/modules');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(module $module)
    {
  
        // on récupère les chapitres du modulen pour les
        // supprimer
        $chapitresToDelete = chapitre::where('module_id', $module->id)
            ->get();

        $chapitreController = new ChapitreController;

        foreach ($chapitresToDelete as $chapitre) {
            $chapitreController->destroy($chapitre);
        }

        $formationId = $module->formation_id;
        $module->delete();

        // on récupère les quiz de la formation pour les
        // supprimer
        $quizToDelete = quiz::where('module_id', $module->id)
            ->get();

        $quizController = new QuizController;

        foreach ($quizToDelete as $quiz) {
            $quizController->destroy($quiz);
        }

        // pour les modules d'une formation donnée
        // réctifie si besoin les valeurs de ordre
        // pour garder la continuité et supprimer les trous
        $modules = module::where('formation_id', $formationId)
            ->orderBy('ordre', 'asc')
            ->get();

        $i = 1;
        foreach ($modules  as $module) {
            if ($module !== $i) {
                $module->ordre = $i;
                $module->save();
                $i++;
            } else {
                $i++;
            }
        }
        return redirect('/modules');
    }


    public function changeOrdre(Request $request)
    {
        $moduleRemplace = module::where('formation_id', $request->formation)
            ->where('ordre', $request->ordre)
            ->first();

        $module = module::where('id', $request->module)->first();

        $modulesCount = module::where('formation_id', $request->formation)->max('ordre');

        // dd($module, $moduleRemplace, $modulesCount);

        if ($request->operation == 'dec') {
            if ($request->ordre > 0) {
                $moduleRemplace->ordre = $module->ordre;
                $moduleRemplace->save();
                $module->ordre = $request->ordre;
                $module->save();
                return redirect('/modules');
            }
        } else if ($request->operation == 'inc') {
            if ($request->ordre <= $modulesCount) {
                $moduleRemplace->ordre = $module->ordre;
                $moduleRemplace->save();
                $module->ordre = $request->ordre;
                $module->save();
                return redirect('/modules');
            }
        }

        return redirect('/modules');
    }
}
