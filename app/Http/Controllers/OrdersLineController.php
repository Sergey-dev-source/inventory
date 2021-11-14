<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersLineController extends Controller
{
    public function store (Request $request) {
        $request->validate([
            'product' => 'required',
            'location' => 'required',
            'qty' => 'required',
            'price' => 'required'
        ]);
    }
}
