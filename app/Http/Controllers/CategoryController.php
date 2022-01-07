<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use DataTables;

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
            'ok' => Category::all(),
            'status' => true,
            'message' => "Category created successfully" 
        ]);
    }
    public function show() {
        $category = Category::select('categories.*',DB::raw('sections.name as section'))->leftJoin('sections','sections.id','=','categories.section_id')->get();
        return DataTables::of($category)->make(true);
    }
    public function shows() {
        $category = Category::get();
        return response()->json($category);
    }

    public function edit(Request $request) {
        $categoryCoant = Category::where('name',$request->name)->where('id','!=',(int)$request->id)->get();
        if (empty($request->name)) {
            $data['status'] = false;
            $data['message'] = "Category name cannot be empty";
            return response()->json($data);
        }else if(count($categoryCoant) >0 ) {
            $data['status'] = false;
            $data['message'] = "Category name ".$request->name." exist";
            return response()->json($data);
        }
        else {
            $category = Category::where('id',(int)$request->id)->first();
            $category->name = $request->name;
            $category->section_id = $request->section_id;
            $category->active = $request->active;
            if ($category->save()) {
                $data['status'] = true;
                $data['message'] = "Category saved successfully";
                $data['ok'] = Category::get();
                return response()->json($data);
            }
        }
    }

    public function delete(Request $request) {
        $category = Category::where('id',(int)$request->id)->delete();
        if ($category) {
            $data['status'] = true;
            $data['message'] = "Section deleted successfully";
            $data['ok'] = Category::get();
            return response()->json($data);
        }
    }
}
