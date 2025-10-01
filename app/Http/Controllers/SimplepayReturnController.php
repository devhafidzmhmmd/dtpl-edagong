<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimplepayReturnController extends Controller
{
    public function return(Request $request)
    {
        // Handle Simplepay return
        return response()->json(['status' => 'success']);
    }

    public function silent(Request $request)
    {
        // Handle Simplepay silent callback
        return response()->json(['status' => 'success']);
    }
}
