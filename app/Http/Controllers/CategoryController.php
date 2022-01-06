<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index() {
        return view('admin.category.index');
    }
    public function getsection() {
        $section = Section::where('active',1)->get();
        return response()->json($section);
    }

    public function story(Request $request) {
        $category = Category::create($request->all());
        return response()->json([
            'ok' => $category,
            'status' => true,
            'message' => "Category created successfully" 
        ]);
    }
}
