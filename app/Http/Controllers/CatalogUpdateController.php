<?php

namespace App\Http\Controllers;

use App\Models\Edited;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CatalogUpdateController extends Controller
{
    public function lock()
    {
        $editedCount = Edited::count();
        if ($editedCount > 0 ){
            $data['status'] = false;
            return response()->json($data);
            die;
        }
        Edited::create([
            'user_id' => Auth::id(),
            'updated' => Carbon::now(),
        ]);
        $data['status'] = true;
        return response()->json($data);

    }
    public function unlock()
    {
        Edited::truncate();
        return response()->json(true);
    }
}
