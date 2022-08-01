<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use App\Models\Question;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = quiz::all();
        $questions = Question::all();
        return view('questions.list', ['questions' => $questions, 'quizzes' => $quizzes]);
    }

    public function indexSelect(Request $request)
    {

        $quizzes = quiz::all();
        if ($request->quiz == 'all quizzes') {
            $questions = Question::orderBy('quiz_id', 'asc')
                ->orderBy('ordre', 'asc')
                ->get();
        } else {
            $questions =  Question::where('quiz_id', '=', $request->quiz)
                ->orderBy('ordre', 'asc')
                ->get();
        }
        return view('questions.list', ['questions' => $questions, 'quizzes' => $quizzes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$questionsCount sert à définir l'ordre des questions dans le quiz. Il pourra être modifié
        $questionsCount = Question::all()->max('ordre') + 1;
        $quizzes = quiz::all();
        return view('questions.form', ['questionsCount' => $questionsCount, 
                                        'quizzes' => $quizzes,
                                        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $validated = $request->validated();

        $question = new Question;
        $question->question = Arr::get($validated, 'question');
        $question->type = Arr::get($validated, 'type');
        $question->ordre = Arr::get($validated, 'ordre');
        $question->quiz_id = Arr::get($validated, 'quiz_id');

        $question->save();

        return redirect('/questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('questions.one', ['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {

        $quizzes = quiz::all();
        return view('questions.edit', ['quizzes' => $quizzes,
        'question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, Question $question)
    {
        $validated = $request->validated();

        $question->question = Arr::get($validated, 'question');
        $question->type = Arr::get($validated, 'type');
        $question->ordre = Arr::get($validated, 'ordre');
        $question->quiz_id = Arr::get($validated, 'quiz_id');

        $question->save();

        return redirect('/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $reponses = $question->reponses;
        foreach ($reponses as $reponse){
            $reponse->delete();
        }
        
        $question->delete();

        return redirect('/questions');
    }
}
