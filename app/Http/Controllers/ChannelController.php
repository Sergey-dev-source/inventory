<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    public function create(Request $request)
    {
        if (empty($request->name)){
            return response()->json(['error'=>'required all fields']);
        }
        $description = '';
        if (!empty($request->description)){
            $description = $request->description;
        }
        $channel = Channel::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description'=> $request->description
        ]);
        return response()->json($channel);
    }
}
