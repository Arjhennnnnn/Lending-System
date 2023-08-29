<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(){
        return view('welcome',[
            'route' => 'login'
        ]);
    }

    public function register(){
        return view('welcome',[
            'route' => 'register'
        ]);
    }

    public function store(Request $request){
        $attributes = $request->validate([
            'name' => 'required',
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => 'required|confirmed|min:8',
        ]);
        $user = User::create($attributes);
        UserDetail::create([
        'user_id' => $user->id,
            'id_card' => '',
            'address' => '',
            'phone' => '',
            'work' => '',
            'income' => '',
            'profile' => ''
        ]);
        return redirect('/register')->with('message','Created Successfully');
    }


    public function process(Request $request){
        $validate = $request -> validate([
            "email" => ['required'],
            "password" => 'required',
        ]);
        if(auth()->attempt($validate)){
            $request->session()->regenerate();
            return redirect('/home')->with('message','Welcome Back');
        }
        throw ValidationException::withMessages([
            'email' => 'Invalid Credentials'
        ]);
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','Logout Successfully');
        // return redirect('/userlogin')->with('message','Logout Successfully');
    }
}
