<?php

namespace App\Http\Controllers;

use App\Models\Slidebar;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;

class SlidebarController extends Controller
{
    public function index() {
        return view('admin.slidebar/index');
    }
    public function store(Request $request)
    {
        $imageName = time().'.'.$request->image->getClientOriginalName();
        $request->image->move(public_path('images/sliders'), $imageName);
        $sliders = new Slidebar();
        $sliders->image = $imageName;
        $sliders->title = $request->title;
        $sliders->description = $request->description;
        $sliders->active = $request->active;
        if ($sliders->save()){
            return response()->json(
                [
                    'ok' => Slidebar::get(),
                    'status' => true,
                    'massage' => 'Images create successfully'
                ]
            );
        }
    }

    public function show() {
        return DataTables::of(Slidebar::get())->make(true);
    }

    public function shows() {
        return response()->json(Slidebar::get());
    }

    public function edit(Request $request) {
        $slider = Slidebar::where('id',$request->id)->first();
        if ($slider['image'] !== $request->image->getClientOriginalName()) {
            $afterImage = public_path('images/sliders/'.$slider['image']);
            if (File::exists($afterImage)){
                File::delete($afterImage);
            }
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images/sliders'), $imageName);
            $slider->image = $imageName;
        }
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->active = $request->active;
        if ($slider->save()){
            return response()->json(
                [
                    'ok' => Slidebar::get(),
                    'status' => true,
                    'massage' => 'Images updated successfully'
                ]
            );
        }
    }

    public function  delete(Request $request) {
        $slider = Slidebar::where('id',$request->id)->first();
        $afterImage = public_path('images/sliders/'.$slider['image']);
        if (File::exists($afterImage)){
            File::delete($afterImage);
        }
        if (Slidebar::where('id',$request->id)->delete()) {
            return response()->json(
                [
                    'ok' => Slidebar::get(),
                    'status' => true,
                    'massage' => 'Images deleted successfully'
                ]
            );
        }
    }
}
