<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Countries;
use App\Models\Order;
use App\Models\UsaStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index() {
        $data['channel'] = Channel::where('user_id',Auth::id())->get();
        return view('orders.index',$data);
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

    public function store (Request $request ) {
        $request->validate([
            'channel' => 'required',
            'customer' => 'required'
        ]);
        $channel_user_id = Channel::where('id',$request->channel)->first();
        $orders = Order::create([
            'user_id' => $channel_user_id['user_id'],
            'create_user_id' => Auth::id(),
            'reference' => $request->reference,
            'additional' => $request->additional,
            'channel_id' => $request->channel,
            'costs' => $request->costs,
            'requested_date' => $request->req_date,
            'remarks' => $request->remarks,
            'customer' => $request->customer,
            'email' => $request->email,
            'street' => $request->street,
            'city' => $request->city,
            'zip' => $request->zip,
            'countryes_id' => $request->countries,
            'state_provincy' => $request->province,
            'state_us' => $request->state,
            'phone' => $request->phone
        ]);
    }

    public function getOrder(Request $request) {
        $where = ['orders.user_id'=> Auth::id()];
        if (isset($request->channels_id) && !empty($request->channels_id)){
            $where['orders.channel_id'] = $request->channels_id;
        }
        $orders = Order::select('orders.*',DB::raw('users.name as users'),DB::raw('channels.name as channels'))
            ->leftJoin('users', 'users.id', '=', 'orders.create_user_id')
            ->leftJoin('channels', 'channels.id', '=', 'orders.channel_id')
            ->where($where)
            ->with('Channel')
            ->orderBy($request->sort,$request->sort_i)
            ->get();
        return response()->json($orders);
    }
}
