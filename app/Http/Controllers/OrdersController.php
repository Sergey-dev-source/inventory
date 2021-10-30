<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index() {
        return view('orders.index');
    }
    public function create() {
        $data['channel'] = Channel::where('user_id',Auth::id())->get();
        return view('orders.create',$data);
    }
}
