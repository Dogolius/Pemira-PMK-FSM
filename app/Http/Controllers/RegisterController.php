<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'nim' => ['required', 'min:14', 'max:14', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
        ]);

        $password = Str::random(8);
        $newUserData = [
            'name' => $validatedData['name'],
            'nim' => $validatedData['nim'],
            'email' => $validatedData['email'],
            'password' => Hash::make($password)
        ];
        //$validatedData['password'] = bcrypt($validatedData['password']);

        User::create($newUserData);
        $data["receiver_name"] = $newUserData['name'];
        $data["email"] = $newUserData['email'];
        $data["password"] = $password;


        // Send the mail...
        Mail::to($newUserData['email'])->send(new MailNotify($data));
        
        //$request->session()->flash('success', 'Registration successfull, please log in');
        return redirect('/dashboard/signup')->with('success', 'Registrasi berhasil, email segera dikirimkan ke alamat tujuan');
        
    }
}
