<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\DataTables;

class InventoryController extends Controller
{
    public function index()
    {

        if (isset($_GET['id'])) {
            $data['id'] = $_GET['id'];
        }
        $data['product'] = Product::where('user_id', Auth::id())->get();
        $data['location'] = Warehouse::where('user_id', Auth::id())->get();


        return view('inventory.index', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'count' => 'required|numeric',
            'product' => 'required',
            'location' => 'required',
        ]);
        $check = Inventory::where([
            'product_id' => $request->product,
            'warehouse_id' => $request->location
        ])->first();
        if ($check) {
            $count = $check->count += $request->count;
            $inventory = Inventory::where([
                'product_id' => $request->product,
                'warehouse_id' => $request->location
            ])->update(['count' => $count]);

        } else {
            $inventory = Inventory::create([
                'user_id' => Auth::id(),
                'count' => $request->count,
                'product_id' => $request->product,
                'warehouse_id' => $request->location
            ]);
        }


        if ($inventory) {
            return redirect()->back()->with(['success' => 'Inventory crated successfully']);
        }
    }

    public function filter()
    {
        $where = [];
        if (isset($_GET['id'])){
            $where['product_id'] =  (int)$_GET['id'];
        }
        $where['user_id'] =  Auth::id();
        $inventory = Inventory::where($where)->with('product')->with('warehouse')->get();

        return DataTables::of($inventory)
            ->make(true);
    }

    public function change_count(Request $request)
    {
        $inventory = Inventory::where('id', $request->id)
            ->update([
                'count' => DB::raw('count+' . $request->value),
            ]);

        if ($inventory) {
            return response()->json(['action' => 'success']);
        }

    }

    public function counts(Request $request) {
        $count = $request->value;
        if (!is_numeric($count) ){
            return response()->json(['action' => 'error','message'=>'Count not numeric']);
        }
        $inventory = Inventory::where('id', $request->id)
            ->update([
                'count' => $count
            ]);

        if ($inventory) {
            return response()->json(['action' => 'success','message'=>'Count changed successful']);
        }
    }

    public function transfer($id) {
        $inventory = Inventory::where('id',$id)->with('product')->with('warehouse')->first();
        $data['inventory'] = $inventory;
        $data['location'] = Warehouse::where('id','!=',$inventory['warehouse']['id'])->where('user_id' ,Auth::id())->get();
       return view('inventory.transfer',$data);
    }

    public function save_transfer(Request $request) {
        $request->validate([
            'location_from'=>'required',
            'location_to'=>'required',
        ]);
        $location_from = Inventory::where('warehouse_id',$request->location_from)->first();
        $count = (integer)$request->qount;
        if ($location_from['count'] < $count) {
            return redirect()->back()->with(['error' => 'error count']);
        }
        $inventory_change = Inventory::where('warehouse_id', $request->location_from)
            ->update([
                'count' => DB::raw('count-' . $count),
            ]);

        if ($inventory_change) {
            $inv = Inventory::create([
                'user_id' => Auth::id(),
                'count' => $count,
                'product_id' => $request->product,
                'warehouse_id' => $request->location_to,
            ]);
            if ($inv){
                return redirect(route('inventory.index'))->with(['success' => 'Inventory product transfered successfully']);
            }
        }
    }
}
