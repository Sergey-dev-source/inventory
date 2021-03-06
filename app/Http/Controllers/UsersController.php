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

        $check = false;
        $message = '';
        $checkuser = true;
        if (Auth::attempt($user)){
            $checkUser = true;
            if (Auth::user()->role_id === 1)  {
                $check = true;
            }else{
                $check = false;
                $message = "You have logged";
            }

        }else{
            $checkUser = false;
            $message = 'Email or password not found';
        }
        $data['checkUser'] = $checkUser;
        $data['redirect'] = $check;
        $data['message'] = $message;
        return response()->json($data);
    }

    public function register(){
        return view('user.register');
    }

    public function register_form(RegisterRequest $request){

       $user =  User::create($request->all());
       if ($user){
           $data['status'] = true;
           $data['message'] = 'Account created successfully';
           return response()->json($data);
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

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
