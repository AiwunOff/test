<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reponse;
use App\Models\Question;
use App\Models\Remember;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReponseRequest;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        $reponses = Reponse::orderBy('question_id', 'desc')->get();
        return view('reponses.list', ['reponses' => $reponses, 'questions' => $questions]);
    }

    public function indexSelect(Request $request)
    {

        $questions = Question::all();
        if ($request->question == 'all questions') {
            $reponses = Reponse::orderBy('question_id', 'asc')
                ->get();
        } else {
            $reponses =  Reponse::where('question_id', '=', $request->question)
                ->get();
        }
        return view('reponses.list', ['reponses' => $reponses, 'questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $questions = Question::all();
        return view('reponses.form', ['questions' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(StoreReponseRequest $request)
    {
        $validated = $request->validated();
        $question_id = Arr::get($validated, 'question_id');
        $is_correct = Arr::get($validated, 'is_correct');

        // on récupère les réponses correctes seulement
        $allReponsesForOneQuestion = Reponse::where('question_id', $question_id)
            ->where('is_correct', 1)
            ->get();

            // dd($allReponsesForOneQuestion);

        // on les compte
        $countReponses = $allReponsesForOneQuestion->count();

        if ($is_correct == 1) {
            $countReponses = $countReponses + 1;
        }

        // on calcule le ratio en fonction du nombre de bonnes réponses
        // plus 1 si la nouvelle réponse est correcte
        if ($countReponses > 0) {
            $value = 1 / ($countReponses);
        } else { $value = 0; }

        // on modifie le/les champ value avec la nouvelle valeur
        foreach ($allReponsesForOneQuestion as $all) {
            $all->value = $value;
            $all->save();
        }

        $reponse = new Reponse;
        $reponse->reponse = Arr::get($validated, 'reponse');
        $reponse->is_correct = Arr::get($validated, 'is_correct');
        $reponse->question_id = Arr::get($validated, 'question_id');
        $is_correct == 1 ? $reponse->value = $value : $reponse->value = 0;

        $reponse->save();

        return redirect('/reponses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function show(Reponse $reponse)
    {
        return view('reponses.one', ['reponse' => $reponse]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function edit(Reponse $reponse)
    {
        $questions = Question::all();
        return view('reponses.edit', [
            'questions' => $questions,
            'reponse' => $reponse
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReponseRequest $request, Reponse $reponse)
    {
        $validated = $request->validated();

        $reponse->reponse = Arr::get($validated, 'reponse');
        $reponse->is_correct = Arr::get($validated, 'is_correct');
        $reponse->question_id = Arr::get($validated, 'question_id');
        $reponse->value = Arr::get($validated, 'is_correct') == 0 && 0;
        $reponse->save();

        $question_id = Arr::get($validated, 'question_id');
        $is_correct = Arr::get($validated, 'is_correct');

        // on récupère les réponses correctes seulement
        $allReponsesForOneQuestion = Reponse::where('question_id', $question_id)
            ->where('is_correct', 1)
            ->get();

        // on les compte
        $countReponses = $allReponsesForOneQuestion->count();

        // on calcule le ratio en fonction du nombre de bonnes réponses
        if ($countReponses > 0) {
            $value = 1 / ($countReponses);
        } else { $value = 0; }

        // on modifie le/les champ value avec la nouvelle valeur
        foreach ($allReponsesForOneQuestion as $all) {
            $all->value = $value;
            $all->save();
        }

        return redirect('/reponses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reponse  $reponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reponse $reponse)
    {

        $question_id = $reponse->question_id;

        $reponse->delete();

        // lorsqu'on supprime une réponse on doit re calculer
        // la valeur des réponses restantes pour une question donnée
        // pour qu'elles valent 1 point toutes ensemble

        // on récupère les réponses correctes seulement
        $allReponsesForOneQuestion = Reponse::where('question_id', $question_id)
            ->where('is_correct', 1)
            ->get();

        // on les compte
        $countReponses = Reponse::where('question_id', $question_id)
            ->where('is_correct', 1)
            ->count();

        // on calcule le ratio en fonction du nombre de bonnes réponses
        if ($countReponses > 0) {
            $value = 1 / ($countReponses);
        } else { $value = 0; }

        foreach ($allReponsesForOneQuestion as $all) {
            $all->value = $value;
            $all->save();
        }


        return redirect('/reponses');
    }
}
