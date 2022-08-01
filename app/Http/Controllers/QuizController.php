<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use App\Models\module;
use App\Models\Question;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Controllers\QuestionController;
use App\Models\Reponse;

class quizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::orderBy('titre', 'asc')
            ->get();
        return view('quizzes.list', ['quizzes' => $quizzes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quiz = Quiz::all('module_id');
        //on envoie seulement les modules qui n'ont pas de quiz
        //pour leur en attribuer un
        $modules = Module::whereNotIn('id', $quiz)->get();
        return view('quizzes.form', ['modules' => $modules]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorequizRequest $request)
    {
        $validated = $request->validated();

        $quiz = new Quiz;
        $quiz->titre = Arr::get($validated, 'titre');
        $quiz->module_id = Arr::get($validated, 'module_id');

        $quiz->save();

        return redirect('quizzes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('quizzes.one', ['quiz' => $quiz]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        $questions = $quiz->questions;

        return view('quizzes.edit', ['quiz' => $quiz, 'questions' => $questions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(StorequizRequest $request, Quiz $quiz)
    {
        $validated = $request->validated();

        $quiz->titre = Arr::get($validated, 'titre');
        $quiz->module_id = Arr::get($validated, 'module_id');

        $quiz->save();

        return redirect('quizzes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {

        // on récupère les questions du quiz pour les
        // supprimer
        $questionsToDelete = Question::where('quiz_id', $quiz->id)
            ->get();

        $questionController = new QuestionController;

        foreach ($questionsToDelete as $question) {
            $questionController->destroy($question);
        }

        $quiz->delete();

        return redirect('/quizzes');
    }



    public function quiz($id)
    {
        $quiz = Quiz::find($id);
        return view('quizzes.quiz', ['quiz' => $quiz]);
    }

    public function quizApi($id)
    {
        // on reçoit l'id d'un module et on return
        // le quiz correspondant avec les relations
        // questions et reponses

        $quiz = Quiz::where('module_id', $id)
            ->with('questions.reponses')->get();

        if ($quiz->isEmpty()) {
            return response()->json(['hide' => 'hide'], 200);
        } else {
            return $quiz;
        }
    }

    public function quizCalculResultat(Request $request)
    {

        // $userRep = explode(',', $request->userReponseVar);
        $points = Reponse::whereIn('id', $request->userReponseVar)
            ->sum('value');
        $nombreQuestions = Question::where('quiz_id', $request->quiz_id)
            ->count();

        $resultat = (100 / $nombreQuestions) * $points;

        return $resultat;
        // return response()->json($userRep);
    }
}
