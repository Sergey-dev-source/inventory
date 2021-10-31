<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Countries;
use App\Models\UsaStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index() {
        return view('orders.index');
    }
    public function create() {
        $data['channel'] = Channel::where('user_id',Auth::id())->get();
        $data['countries'] = Countries::all();
        return view('orders.create',$data);
    }
    public function state() {

        $state = UsaStates::all();
        return response()->json($state);
    }
}
