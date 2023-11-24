<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    //
    public function index(){
        if(Auth::check()){
            if(Gate::allows('admin')){
                return redirect()->intended('/dashboard/result');
            }
            if(Gate::allows('voter')){
                return redirect()->intended('/dashboard/vote');
            }
        }
        return view('login', [
            'title' => "Login",
            'active' => "login"
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Gate::allows('admin')){
                return redirect()->intended('/dashboard/result');
            }
            if(Gate::allows('voter')){
                return redirect()->intended('/dashboard/vote');
            }
        }

        return back()->with('loginError', 'Login failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }
}
