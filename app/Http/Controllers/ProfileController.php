<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Countrie;
use App\Models\Certificat;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function getUser()
    {
        if (Auth::user()) {
            $user = Auth::user();

            $infos_quiz = DB::table('reponse_users')
                ->select(
                    'score',
                    'quizzes.titre as quiz_titre',
                    'formations.titre as formation_titre',
                    'formations.detail as formation_detail',
                    'modules.titre as module_titre'
                )
                ->join('quizzes', 'quizzes.id', '=', 'reponse_users.quiz_id')
                ->join('modules', 'modules.id', '=', 'quizzes.module_id')
                ->join('formations', 'formations.id', '=', 'modules.formation_id')
                ->where('reponse_users.user_id', $user->id)
                ->orderBy('formations.titre', 'asc')
                ->orderBy('modules.titre', 'asc')
                ->get();


            $infos_certificat = DB::table('certificats')
            ->select(
                'certificats.*',
                'formations.detail as detail',
            )
            ->join('formations', 'formations.id', '=', 'certificats.formation_id')
            ->where('certificats.user_id', $user->id)
            ->get();

            // dd($infos_certificat);

            return view('profile.profile', [
                'user' => Auth::user(),
                'infos_quiz' => $infos_quiz,
                'infos_certificat' => $infos_certificat,
            ]);
        }
    }


    public function storeCompleteProfile(Request $request)
    {

        $user = User::find($request->id);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->sexe = $request->sexe;
        $user->email = $request->email;
        $user->admin = $user->admin;
        $user->password = $user->password;
        $user->pays = $request->pays;
        $user->ville = $request->ville;
        $user->tranche_age = $request->tranche_age;

        $user->save();

        return redirect('/profile');
    }
}
