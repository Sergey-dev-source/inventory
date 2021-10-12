<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Request $request){
        if (empty($request->name) || empty($request->description)){
            return response()->json(['error'=>'required all fields']);
        }
        $category = Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description'=> $request->description
        ]);
        return response()->json($category);
    }
}
