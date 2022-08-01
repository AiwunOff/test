<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $request->validate([
                    'user_name' => 'required|string|max:255',
                    'user_mail' => 'required|string|max:255',
                    'user_message' => 'required|string|max:2000',
                    'g-recaptcha-response' => 'required',
                ]);
                
        $secret = \config('captcha.v2-checkbox');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $request['g-recaptcha-response'],
        ]);
        
        if ($response->json()['success'] == true)
            {
                Mail::raw($request->user_message, function ($message) {
                    $message->subject('Message de m-egalitefemmeshommes.org')
                    ->to('mouvementegalite.femmeshommes@gmail.com');
                });
            }

        return View('contact');
    }

}
