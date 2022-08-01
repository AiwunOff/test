<?php

namespace App\Http\Controllers;

use App\Models\formation;
use App\Models\Ressource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRessourceRequest;

class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = formation::all();
        $ressources = Ressource::all();
        return view('ressources.list', ['ressources' => $ressources, 'formations' => $formations]);
    }

    public function indexSelect(Request $request)
    {

        $formations = formation::all();
        if ($request->formation == 'all formations') {
            $ressources = Ressource::orderBy('formation_id', 'asc')
                ->get();
        } else {
            $ressources =  Ressource::where('formation_id', '=', $request->formation)
                ->get();
        }
        return view('ressources.list', ['ressources' => $ressources, 'formations' => $formations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formations = formation::all();
        return view('ressources.form', ['formations' => $formations]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRessourceRequest $request)
    {
        $validated = $request->validated();

        $ressource = new Ressource;
        $ressource->text = Arr::get($validated, 'text');
        $ressource->formation_id = Arr::get($validated, 'formation_id');

        $ressource->save();

        return redirect('/ressources');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ressource $ressource)
    {
        $formation = formation::find($ressource->formation_id);
        $formations = formation::all();
        return view('ressources.edit', [
            'ressource' => $ressource,
            'formation_old' => $formation,
            'formations' => $formations
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRessourceRequest $request, Ressource $ressource)
    {
        $validated = $request->validated();

        $ressource->text = Arr::get($validated, 'text');
        $ressource->formation_id = Arr::get($validated, 'formation_id');

        $ressource->save();

        return redirect('/ressources');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ressource $ressource)
    {
        $ressource->delete();

        return back();
    }


}
