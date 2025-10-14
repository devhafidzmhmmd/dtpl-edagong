<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vanilo\Foundation\Models\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->with(['items', 'billpayer', 'shippingAddress'])
            ->get();

        return view('order.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to order.');
        }

        $order->load(['items', 'billpayer', 'shippingAddress']);

        return view('order.show', compact('order'));
    }
}
