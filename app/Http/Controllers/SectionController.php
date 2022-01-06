<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use DataTables;

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
                $data['ok'] = Section::get();
                return response()->json($data);
            }
        }
    }

    public function show() {
        $section = Section::get();
        return DataTables::of($section)->make(true);
    }
    public function shows() {
        $section = Section::get();
        return response()->json($section);
    }
    public function edit(Request $request){
        $sectionCoant = Section::where('name',$request->name)->where('id','!=',(int)$request->id)->get();
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
            $section = Section::where('id',(int)$request->id)->first();
            $section->name = $request->name;
            $section->active = $request->active;
            if ($section->save()) {
                $data['status'] = true;
                $data['messages'] = "Section saved successfully";
                $data['ok'] = Section::get();
                return response()->json($data);
            }
        }
    }
    public function delete(Request $request){
        $section = Section::where('id',(int)$request->id)->delete();
        if ($section) {
            $data['status'] = true;
            $data['messages'] = "Section deleted successfully";
            $data['ok'] = Section::get();
            return response()->json($data);
        }
    }

    public function search(Request $request) {
        $section = Section::where('name', 'LIKE', "$request->name%")->get();
        $data['status'] = true;
        $data['ok'] = $section;
        return response()->json($data);
    }
}
