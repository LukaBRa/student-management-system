<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    
    public function loginAuthentification(Request $request) {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email adresa je obavezna.',
            'email.email' => 'Neispravna email adresa.',
            'password.required' => "Lozinka je obavezna",
        ]);

        if(Auth::attempt($credentials, $request->remember)){
            $request->session()->regenerate();

            return redirect("/administracija");
        }

        return redirect("/")->withErrors(['invalidData' => 'Niste uneli ispravne podatke']);
    }

    public function logout(Request $request): RedirectResponse {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
