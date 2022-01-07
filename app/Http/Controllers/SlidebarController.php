<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlidebarController extends Controller
{
    public function index() {
        return view('admin.slidebar/index');
    }
}
