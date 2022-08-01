<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use App\Models\User;
use App\Models\module;
use App\Models\Reponse;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function entry(){    
        $modulesCount = Module::all()->count() ?  Module::all()->count() : '0';
        $modulesLast = strlen(Module::all()->last()) ? Module::all()->last()->titre : 'Pas de données';
        $questionsCount = Question::all()->count() ? Question::all()->count() : '0';
        $questionsLast = strlen(Question::all()->last()) ? Question::all()->last()->question : 'Pas de données';
        $quizzesCount = Quiz::all()->count() ? Quiz::all()->count() : '0';
        $quizzesLast = strlen(Quiz::all()->last()) ? Quiz::all()->last()->titre : 'Pas de données';
        $reponsesCount = Reponse::all()->count() ? Reponse::all()->count() : '0';
        $reponsesLast = strlen(Reponse::all()->last()) ? Reponse::all()->last()->reponse : 'Pas de données';
        $usersCount = User::all()->count() ? User::all()->count() : '0';
        $usersLast = strlen(User::all()->last()) ? User::all()->last()->nom : 'Pas de données';

        return view('dashboard', ['modulesCount' => $modulesCount,
                                'modulesLast' => $modulesLast,
                                'questionsCount' => $questionsCount,
                                'questionsLast' => $questionsLast,
                                'quizzesCount' => $quizzesCount,
                                'quizzesLast' => $quizzesLast,
                                'reponsesCount' => $reponsesCount,
                                'reponsesLast' => $reponsesLast,
                                'usersCount' => $usersCount,
                                'usersLast' => $usersLast,
                                'user' => Auth::user(),
                                ]);
    }

}
