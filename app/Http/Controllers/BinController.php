<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BinController extends Controller
{
   public function create(Request $request) {
       if (empty($request->name)){
           return response()->json(['error'=>'required all fields']);
       }
       $category = Bin::create([
           'user_id' => Auth::id(),
           'name' => $request->name,
       ]);
       return response()->json($category);
   }
}
