<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function login(Request $request){
        $user = $request->only(['email','password']);
        if (Auth::attempt($user)){
            return redirect(route('dashboard'));
        }else{
            return redirect()->back()->withErrors('Email or password not found');
        }
    }

    public function register(){
        return view('user.register');
    }

    public function register_form(RegisterRequest $request){
       $user =  User::create($request->all());
       if ($user){
           return redirect()->back()->withSuccess('account created successfully');
       }
    }
}
