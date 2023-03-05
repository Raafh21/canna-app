<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'login'
        ]);
    }

    public function admin(Request $request)
    {
        $credentials = $request->validate([
            'email' =>'required|email:dns',
            'password' => 'required'
        ]);

        if(auth :: attempt($credentials)){
            $request-> session()->regenerate();
            return redirect()->intended('/admin');
        }
        
        return back()->with('loginError','login gagal');
    }
}
