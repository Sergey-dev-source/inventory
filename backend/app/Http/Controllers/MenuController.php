<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index () {
        $section = Section::with('category')->whereHas('category', function($q)
        {
            $q->where('active', '=', 1);
        })->get();
        return response()->json($section);
    }
}
