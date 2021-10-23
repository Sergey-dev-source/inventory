<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\currency;
use App\Models\User;
use App\Models\Zone;
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

    public function settings()
    {
        $data['currency'] = currency::all();

        $data['zone'] = Zone::all();
        return view('user.settings',$data);
    }

    public function settings_post(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id',$id)->first();
        if (!empty($request->currency_id)) {
            $user->currency_id = $request->currency_id;
        }
        if (!empty($request->time_zone_id)) {
            $user->time_zone_id = $request->time_zone_id;
        }
        $user->save();
        if ($user)
        {
            return redirect()->back()->with(['success' => 'Settings updated successfully']);
        }
    }
}
