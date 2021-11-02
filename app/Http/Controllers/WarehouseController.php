<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    public function index() {
        return view('warehouse.index');
    }

    public function filter() {
        $warehouse = Warehouse::where('user_id',Auth::id())->get();
        return DataTables::of($warehouse)->make(true);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $warehouse = Warehouse::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'status' => $request->status,
        ]);
        if ($warehouse) {
            return redirect()->back()->with(['success' => 'Location ' . $request->name . ' crated successfully']);
        }
    }

    public function edit($id) {
        $data['warehouse'] = Warehouse::where('id',$id)->first();
        return view('warehouse.edit',$data);
    }
    
    public function change_status(Request $request){
        $warehouse = Warehouse::where('id',$request->id)->update(['status' => $request->status]);
        if ($warehouse){
            return response()->json(['action'=>'success']);
        }
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $warehouse = Warehouse::where('id',$request->id)->update(['status' => $request->status,'name' => $request->name]);
        if ($warehouse){
            return redirect()->back()->with(['success' => 'Location ' . $request->name . ' updatet successfully']);
        }
    }
    public function delete(Request $request) {
        $id = $request->id;
        $i_location = Inventory::where('warehouse_id',$id)->get();
        // echo $id . '<br>' . count($i_location);die;
        if (count($i_location) > 0){
            return response()->json(['action'=>'error','message'=>"Location isset in Invetory"]);
        }else {
            $warehouse = Warehouse::where('id',$id)->delete();
            if ($warehouse){
                return response()->json(['action'=>'success']);
            }
        }
    }
}
