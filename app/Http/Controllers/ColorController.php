<?php

namespace App\Http\Controllers;
;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function create(Request $request) {
        if (empty($request->name || $request->code)){
            return response()->json(['error'=>'required all fields']);
        }
        $color = Color::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'code' => $request->code,
        ]);
        return response()->json($color);
    }
}
