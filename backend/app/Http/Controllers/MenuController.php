<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index () {
        $section = Section::with('category')->get();
        return response()->json($section);
    }
}
