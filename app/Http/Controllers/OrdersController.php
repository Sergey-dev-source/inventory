<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Countries;
use App\Models\currency;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrdersLine;
use App\Models\UsaStates;
use DateTime;
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
        
        if ($orders){
            return redirect('/order/detail/'.$orders['id'].'?status=order');
        }
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

    public function details(Request $request) {
        if (isset($request->status) && $request->status === 'order'){
            $data['status_orderline'] = $request->status;
        }else{
            $data['status_orderline'] = 'none';
        }
        
        $ord = Order::select(
            'orders.*',
            DB::raw('users.name as users'),
            DB::raw('channels.user_id as channels_user'),
            DB::raw('channels.name as channels'),
            DB::raw('countries.name as country'),
            DB::raw('usa_states.name as usa_states'))
            ->leftJoin('users', 'users.id', '=', 'orders.create_user_id')
            ->leftJoin('channels', 'channels.id', '=', 'orders.channel_id')
            ->leftJoin('countries', 'countries.id', '=', 'orders.countryes_id')
            ->leftJoin('usa_states', 'usa_states.id', '=', 'orders.state_us')
            ->where('orders.id',$request->id)
            ->with('Channel')
            ->first();
        $create = new DateTime($ord['created_at']);
        $data['create_order'] = $create->format('F j Y H:i A');
        $data['order'] = $ord;
        $data['curency'] = currency::where('id',Auth::user()->currency_id)->first();
        if (!empty($ord['requested_date'])){
            $requestedDate = new DateTime($ord['requested_date']);
            $data['requestedDate'] = $requestedDate->format('F j Y H:i A');
        }else {
            $data['requestedDate'] = '';
        }
        $orderLine = OrdersLine::select(
                'orders_lines.*',
                DB::raw('products.name as product'),
                DB::raw('warehouses.name as location'),
                DB::raw('users.name as users'),
            )
            ->leftJoin('users', 'users.id', '=', 'orders_lines.dcop_user_id')
            ->leftJoin('products', 'products.id', '=', 'orders_lines.product_id')
            ->leftJoin('warehouses', 'warehouses.id', '=', 'orders_lines.warehouse_id')
            ->where(['orders_lines.order_id'=>$request->id,'orders_lines.user_id'=>Auth::id()])
            ->get();
        
        $totals = 0;
        foreach($orderLine as $item){
            $totals+= $item['total'];
        }
        $data['orderLine'] = $orderLine;
        $data['totals'] = $totals;
        
        return view('orders.details',$data);
    } 
    public function getproduct()
    {
        $product = Inventory::where('user_id',Auth::id())->with('product')->with('warehouse')->get();
        return response()->json($product);
    }
    public function getlocation($id)
    {
        $location = Inventory::where(['user_id'=>Auth::id(),'product_id'=>$id])->with('warehouse')->get();
        return response()->json($location);
    }

}
