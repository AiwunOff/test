<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\formation;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFaqRequest;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $formations = formation::all();
        $faqs = Faq::all();
        return view('faqs.list', ['faqs' => $faqs, 'formations' => $formations]);
    }


    public function indexSelect(Request $request)
    {

        $formations = formation::all();
        if ($request->formation == 'all formations') {
            $faqs = Faq::orderBy('formation_id', 'asc')
                ->get();
        } else {
            $faqs =  Faq::where('formation_id', '=', $request->formation)
                ->get();
        }
        return view('faqs.list', ['faqs' => $faqs, 'formations' => $formations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formations = formation::all();
        return view('faqs.form', ['formations' => $formations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqRequest $request)
    {
        $validated = $request->validated();

        $faq = new Faq;
        $faq->question = Arr::get($validated, 'question');
        $faq->reponse = Arr::get($validated, 'reponse');
        $faq->formation_id = Arr::get($validated, 'formation_id');

        $faq->save();

        return redirect('faqs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return $faq;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $formation = formation::find($faq->formation_id);
        $formations = formation::all();
        return view('faqs.edit', [
            'faq' => $faq,
            'formation_old' => $formation,
            'formations' => $formations
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFaqRequest $request, Faq $faq)
    {
        $validated = $request->validated();

        $faq->question = Arr::get($validated, 'question');
        $faq->reponse = Arr::get($validated, 'reponse');
        $faq->formation_id = Arr::get($validated, 'formation_id');

        $faq->save();

        return redirect('faqs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return back();
    }

    // renvoi la faq d'une formation donnée
    // public function faqIndex($idFormation)
    // {
    //     $faq = Faq::where('formation_id', '=', $idFormation)
    //         ->get();

    //     if ($faq->isEmpty()) {
    //         return response()->json(['hide' => 'hide'], 200);
    //     } else {
    //         return $faq;
    //     }
    // }


    // renvoi les questions et réponses qui contiennent le mot 
    // dans $request->value pour une formation donnée
    public function getChange(Request $request)
    {
        return Faq::where([
            ['question', 'like', '%' . $request->value . '%'],
            ['formation_id', '=', $request->formation_id],
        ])
            ->orWhere([
                ['reponse', 'like', '%' . $request->value . '%'],
                ['formation_id', '=', $request->formation_id],
            ])
            ->get();
    }
}
