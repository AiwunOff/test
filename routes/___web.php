<?php


use App\Models\Langue;
use App\Models\Countrie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcellExport;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ModuleResController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\ReactRequestController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


    Route::middleware(['visitors'])->get('/', function () {
        return view('accueil', ['lang' => Lang::locale()]);
    });

    Route::middleware(['visitors'])->get('/formations-liste', function () {
        return view('formations', [
            'formations' => DB::table('formations')->orderBy('ordre')->get(),
            'langue' => 'Toutes les langues',
            'langues' => DB::table('formations')
            ->select('langue')
            ->distinct()
            ->orderBy('langue')
            ->get(),
        ]);
    });


    Route::middleware(['visitors'])->get('/contact', function () {
        return View('contact');
    });

    Route::middleware(['visitors'])->get('/vie-privee', function () {
        return View('legale.viePrivee');
    });

    Route::middleware(['visitors'])->get('/cookies', function () {
        return View('legale.cookies');
    });

    Route::middleware(['visitors'])->get('/conditionsUtilisation', function () {
        return View('legale.conditionsUtilisation');
    });

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });


    Route::middleware(['visitors'])->get('/formation/{id}', function () {
        return view('indexFormations', ['id' => request('id')]);
    });

    Route::get('/formationsLangue', [FormationController::class, 'formationsLangue']);

    Route::middleware(['visitors'])->get('/profile', [ProfileController::class, 'getUser']);
    Route::post('/profileUpadate', [ProfileController::class, 'storeCompleteProfile']);

    Route::get('/edit-profile', function () {
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile.edit', ['user' => $user,
            'countries' => Countrie::select('langFR')->orderBy('langFr', 'asc')->get()]);
        }
    });

    Route::get('/pdf', [CertificatController::class, 'createPdf']);

    // en mettant cette route ici je peut obtenir son url et savoir dans quelle langue on est pour gérer le multilangue dans react
    Route::get('/getLiens/{params}', [ReactRequestController::class, 'getLiens']);  

});


Route::get('visitor', [VisitorController::class, 'visit']);

require __DIR__ . '/auth.php';

// <--- appelé dans ListeChapitre et coursCompleted, à supprimer !!!! ??????
Route::resource('modulesApi', ModuleResController::class); 
Route::post('chapitreBackNext', [ModuleResController::class, 'chapitreBackNext']); 


Route::group(['middleware' => 'checkAdmin'], function () {
    Route::resource('formations', FormationController::class);
    Route::resource('chapitres', ChapitreController::class);
    Route::resource('modules', ModuleResController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('quizzes', QuizController::class);
    Route::resource('reponses', ReponseController::class);
    Route::resource('users', UserController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('ressources', RessourceController::class);

    Route::get('/dashboard', [StatsController::class, 'getStats']);

    // renvoi des résultats filtrés par le choix fait dans un menu select 
    // dans les listes de la partie admin
    
    Route::post('/chapitresOneModule', [ChapitreController::class, 'indexSelect']);
    Route::post('/modulesOneFormation', [ModuleResController::class, 'indexSelect']);
    Route::post('/questionsOneQuiz', [QuestionController::class, 'indexSelect']);
    Route::post('/reponsesOneQuestion', [ReponseController::class, 'indexSelect']);
    Route::post('/faqsOneFormation', [FaqController::class, 'indexSelect']);
    Route::post('/ressourcesOneQuestion', [RessourceController::class, 'indexSelect']);
});






Route::get('/quizzes/quiz/{id}', [QuizController::class, 'quiz']);
Route::get('/quizzes/quizApi/{id}', [QuizController::class, 'quizApi']);
Route::post('/reponses_user', [UserController::class, 'reponseUser']);
Route::get('/users/profile/{id}', [UserController::class, 'user']);
Route::post('/checkUser', [UserController::class, 'checkUser']);
Route::post('/usersFromQuizForm', [UserController::class, 'store2']);
Route::post('/chapitreSuivi', [ChapitreController::class, 'suivi']);
Route::get('/chapitreSuiviList', [ChapitreController::class, 'list']);
Route::get('/faqChange', [FaqController::class, 'getChange']);
Route::get('/faqIndex/{params}', [FaqController::class, 'faqIndex']);

//Route::get('/createAdmin', [UserController::class, 'createAdmin']);



// gestion des changements d'ordre dans modules, formations et chapitres
Route::get('/changeOrdreModule', [ModuleResController::class, 'changeOrdre']);
Route::get('/changeOrdreFormation', [FormationController::class, 'changeOrdre']);
Route::get('/changeOrdreMChapitre', [ChapitreController::class, 'changeOrdre']);




// upload d'images pour ckeditor
Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

// export de fichiers excell
Route::get('export', [ExcellExport::class, 'export'])->name('export');

Route::post('/sendmail', [MailController::class, 'sendMail']);













