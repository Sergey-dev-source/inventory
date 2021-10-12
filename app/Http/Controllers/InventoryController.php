<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InventoryController extends Controller
{
    public function index()
    {
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
        $inventory = Inventory::where('user_id', Auth::id())->with('product')->with('warehouse')->get();

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
}
