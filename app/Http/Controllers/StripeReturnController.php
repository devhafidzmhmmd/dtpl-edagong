<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeReturnController extends Controller
{
    public function webhook(Request $request)
    {
        // Handle Stripe webhook
        return response()->json(['status' => 'success']);
    }
}
