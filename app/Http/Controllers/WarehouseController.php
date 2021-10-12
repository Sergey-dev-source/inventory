<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
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
}
