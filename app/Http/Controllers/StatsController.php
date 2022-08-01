<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\formation;
use Illuminate\Support\Facades\DB;


class StatsController extends Controller
{
    public function getStats()
    {

        $formations = formation::all();

        // Quiz----------------------------------------------------------------

        $quiz = DB::table('reponse_users')
            ->select(
                'quizzes.id as quiz_id',
                'modules.titre as quiz_titre',
                DB::raw('count(*) as countQuiz')
            )
            ->join('quizzes', 'quizzes.id', '=', 'reponse_users.quiz_id')
            ->join('modules', 'modules.id', '=', 'quizzes.module_id')
            ->join('formations', 'formations.id', '=', 'modules.formation_id')
            ->orderBy('countQuiz', 'asc')
            ->groupBy('modules.titre')
            ->groupBy('quizzes.id')
            ->get();



        // Certificat-----------------------------------------------------------

        $certificat = DB::table('certificats')
            ->select(
                'certificats.id as certificat_id',
                DB::raw('count(*) as countCertificat'),
                'formations.titre as formation_titre'
            )
            ->join('formations', 'formations.id', '=', 'certificats.formation_id')
            ->orderBy('countCertificat', 'asc')
            ->groupBy('certificats.formation_id')
            ->groupBy('certificats.id')
            ->groupBy('formations.titre')
            ->get();



        // Users----------------------------------------------------------------

        $userAge = DB::table('users')
            ->select(
                DB::raw('count(*) as countUserAge'),
                'users.tranche_age as user_age'
            )
            ->orderBy('countUserAge', 'asc')
            ->groupBy('users.tranche_age')
            ->get();

        $userSexe = DB::table('users')
            ->select(
                DB::raw('count(*) as countUserSexe'),
                'users.sexe as user_sexe'
            )
            ->orderBy('countUserSexe', 'asc')
            ->groupBy('users.sexe')
            ->get();

        $userPays = DB::table('users')
            ->select(
                DB::raw('count(*) as countUserPays'),
                'users.pays as user_pays'
            )
            ->orderBy('countUserPays', 'asc')
            ->groupBy('users.pays')
            ->get();

        $userVille = DB::table('users')
            ->select(
                DB::raw('count(*) as countUserVille'),
                'users.ville as user_ville'
            )
            ->orderBy('countUserVille', 'asc')
            ->groupBy('users.ville')
            ->get();



        // Visitors-------------------------------------------------------------

        $platform = DB::table('shetabit_visits')
            ->select(
                'platform',
                DB::raw('count(*) as countPlatform')
                )

            ->orderBy('countPlatform', 'asc')
            ->groupBy('platform')
            ->get();


       
        $dailyVisit = DB::table('shetabit_visits')
            ->select(
                DB::raw('count(distinct(ip)) as countIp'),
                DB::raw("DATE(created_at) as date"),
                DB::raw('count(*) as countVisit')
            )
            ->whereDate('created_at', '>', Carbon::now()->subDays(365))
            ->orderBy('date', 'asc')
            ->groupBy('date')
            ->get();


        $urlVisit = DB::table('shetabit_visits')
            ->select(
                'url',
                DB::raw('count(url) as countUrl')
            )
            ->orderBy('url', 'asc')
            ->groupBy('url')
            ->get();


        return view('dashboard', [
            'quiz' => $quiz,
            'certificat' => $certificat,
            'userAge' => $userAge,
            'userSexe' => $userSexe,
            'userPays' => $userPays,
            'userVille' => $userVille,
            'platform' => $platform,
            'dailyVisit' => $dailyVisit,
            'urlVisit' => $urlVisit,
            'formations' => $formations,
        ]);
    }
}
