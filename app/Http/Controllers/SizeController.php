<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
{
    public function create(Request $request) {
        if (empty($request->name )){
            return response()->json(['error'=>'required all fields']);
        }
        $size = Size::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);
        return response()->json($size);
    }
}
