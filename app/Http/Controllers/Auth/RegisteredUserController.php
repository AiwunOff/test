<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
                    'nom' => 'required|string|max:255',
                    'prenom' => 'required|string|max:255',
                    'sexe' => 'required|string|max:20',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|confirmed|min:8',
                    'rgpd' => 'required',
                    'g-recaptcha-response' => 'required',
                ]);
                
        $secret = \config('captcha.v2-checkbox');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $request['g-recaptcha-response'],
        ]);
        

        if ($response->json()['success'] == true)
            {
                Auth::login($user = User::create([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'sexe' => $request->sexe,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'admin' => 0,
                    'rgpd' => 1
                ]));
        
                event(new Registered($user));
                return redirect(RouteServiceProvider::HOME);
            }

        return redirect()->route('register');
        
    }
}
