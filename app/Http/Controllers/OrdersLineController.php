<?php

namespace App\Http\Controllers;

use App\Models\OrdersLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrdersLineController extends Controller
{
    public function store (Request $request) {
        $validate = Validator::make($request->all(),[
            'product' => 'required',
            'location' => 'required',
            'qty' => 'required',
            'price' => 'required'
        ]);
        if ($validate->fails()){
            $data['action'] = 'error';
            $data['msg'] = $validate->errors();
            return response()->json($data);
        }

        $total = $request->qty * $request->price; 
        $line = OrdersLine::create([
            'user_id' => $request->user_id,
            'order_id' => $request->id,
            'dcop_user_id' => Auth::id(),
            'product_id' => $request->product,
            'warehouse_id' => $request->location,
            'count' => $request->qty,
            'price' => $request->price,
            'total' => $total,
            'commet' => $request->remarks
        ]);
        $orderLine = OrdersLine::select(
            'orders_lines.*',
            DB::raw('products.name as product'),
            DB::raw('warehouses.name as location'),
            DB::raw('users.name as users'),
        )
        ->leftJoin('users', 'users.id', '=', 'orders_lines.dcop_user_id')
        ->leftJoin('products', 'products.id', '=', 'orders_lines.product_id')
        ->leftJoin('warehouses', 'warehouses.id', '=', 'orders_lines.warehouse_id')
        ->where(['orders_lines.id'=>$line['id'],'orders_lines.user_id'=>Auth::id()])
        ->first();
        $data['action'] = 'success';
       
        $data['msg'] = $orderLine ;
    
        return response()->json($data);
    }
}
