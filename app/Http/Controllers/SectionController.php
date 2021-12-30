<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index() {
        return view('admin.section.index');
    }
    public function store(Request $request) {
        $sectionCoant = Section::where('name',$request->name)->get();
        if (empty($request->name)) {
            $data['status'] = false;
            $data['messages'] = "Section name cannot be empty";
            return response()->json($data);
        }else if(count($sectionCoant) >0 ) {
            $data['status'] = false;
            $data['messages'] = "Section name ".$request->name." exist";
            return response()->json($data);
        }
        else {
            $section = Section::create($request->all());
            if ($section) {
                $data['status'] = true;
                $data['messages'] = "Section saved successfully";
                return response()->json($data);
            }
        }
    }

    public function show() {
        $section = Section::get();
        return response()->json($section);
    }
}
