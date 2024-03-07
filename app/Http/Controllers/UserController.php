<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(){
        return view('users.create');


    }

    public function store(Request $request){
                $formValues = $request->validate([
            'name'=>['required','min:3'],
            'email'=>['required','email', Rule::unique('users','email')],
            'password'=> ['required','confirmed','min:6']
        ]);

        $formValues['password'] = bcrypt($formValues['password']);

        $user = User::create($formValues);

        auth()->login($user);

        return redirect('/');

    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function login(){
        return view('users.login');
    }

    public function authnticate(Request $request){
        $formValues = $request->validate([
            'email'=>['required','email'],
            'password'=> 'required'
        ]);

        if(auth()->attempt($formValues)){
            $request->session()->regenerate();
            return redirect('/');

            
        }
        return back()->withErrors(['email'=>'invalid credentials'])->onlyInput('email');
    }
}
