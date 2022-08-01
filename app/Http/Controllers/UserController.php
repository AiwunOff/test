<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reponse;
use App\Models\Certificat;
use Illuminate\Support\Arr;
use App\Models\Reponse_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Models\formation;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $validated = $request->validated();

        $user = new User;
        $user->nom = Arr::get($validated, 'nom');
        $user->prenom = Arr::get($validated, 'prenom');
        $user->sexe = Arr::get($validated, 'sexe');
        $user->admin = Arr::get($validated, 'admin');
        $user->email = Arr::get($validated, 'email');
        $user->password = Hash::make(Arr::get($validated, 'password'));

        $user->save();

        return redirect('/users');
    }

    // crée un nouvel utilisateur via un formulaire proposé
    // quand on veut sauvegarder les résultats d'un quiz et 
    // qu'on est pas déjà inscrit
    public function store2(Request $request)
    {

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->sexe = $request->sexe;
        $user->admin = 0;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->rgpd = 1;

        $user->save();
        return json_encode($user->id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.one', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, User $user)
    {

        $validated = $request->validated();

        $user->nom = Arr::get($validated, 'nom');
        $user->prenom = Arr::get($validated, 'prenom');
        $user->sexe = Arr::get($validated, 'sexe');
        $user->admin = Arr::get($validated, 'admin');
        $user->email = Arr::get($validated, 'email');
        $user->password = Hash::make(Arr::get($validated, 'password'));

        $user->save();

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users');
    }


    public function user($id)
    {
        $user = User::find($id);
        return view('users.profile', ['user' => $user]);
    }


    // sauve le score d'un quiz et efface le précédent socre
    // s'il existe
    public function reponseUser(Request $request)
    {
        $user = User::find($request->id);
        // connexion de l'user
        if ($request->has(['email', 'password'])) {
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
        }

        //on éfface le précédent score s'il existe
        Reponse_user::where('quiz_id', $request->quiz_id)
            ->where('user_id', $request->id)
            ->delete();

        // insertion du nouveau score
        $reponse_user = new Reponse_user;
        $reponse_user->score = $request->resultat;
        $reponse_user->user_id = $request->id;
        $reponse_user->quiz_id = $request->quiz_id;
        $reponse_user->formation_id = $request->formation_id;
        $reponse_user->save();

        $gotCertificat = false;

        // renvoi tous les quiz pour une formation donnée
        $allQuizFromFormation = DB::table('modules')
            ->select(
                'quizzes.id as quiz_id',
            )
            ->join('formations', 'formations.id', '=', 'modules.formation_id')
            ->join('quizzes', 'modules.id', '=', 'quizzes.module_id')
            ->where('formation_id', $request->formation_id)
            ->count();

        // renvoi le nombre de quiz réussis par l'user
        $quizDone = Reponse_user::where('user_id', $request->id)
            ->where('formation_id', $request->formation_id)
            ->count();

        // si user a réussi tous les quiz de la formation 
        // alors on l'enregistre dans la table certificat

        $hasCertificat = Certificat::where('user_id', $user->id)
            ->where('formation_id', $request->formation_id)
            ->exists();

        if ($quizDone == $allQuizFromFormation && $hasCertificat == false) {
            $gotCertificat = true;
            $formation = formation::find($request->formation_id);
            $certificat = new Certificat;
            $certificat->user_id = $user->id;
            $certificat->nom = $user->nom;
            $certificat->prenom = $user->prenom;
            $certificat->formation_id = $formation->id;
            $certificat->formation = $formation->titre;
            $certificat->save();
        }

        if ($quizDone == $allQuizFromFormation && $hasCertificat == true) {
            $gotCertificat = true;
        }

        return json_encode($gotCertificat);
    }

    // vérifie si user existe et que le password est ok
    public function checkUser(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return  Auth::id();
        }

        return 'user not exist';
    }

    // public function createAdmin()
    // {


    //     $user = new User;
    //     $user->nom = 'said';
    //     $user->prenom = 'said';
    //     $user->sexe = 'Masculin';
    //     $user->admin = '1';
    //     $user->email = 'said@mail.com';
    //     $user->password = Hash::make('1234aaaa');
    //     $user->pays = 'Belgique';
    //     $user->ville = '5030';
    //     $user->tranche_age = 'entre 45 et 55 ans';
    //     $user->save();


    // }
}
