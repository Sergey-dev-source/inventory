<?php

namespace App\Http\Controllers;

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
}
