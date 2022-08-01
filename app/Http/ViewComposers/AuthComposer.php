<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AuthComposer
{

    public function compose(View $view)
    {
        // si Auth alors on envoi nom, prenom et id à layout.nav via un provider
        // sinon on envoi 0 à layout.nav
        

        Auth::check() ? 
        $view->with('auth', [Auth::user()->nom, Auth::user()->prenom, Auth::user()->id]) : 
        $view->with('auth', '0');
    }
}
