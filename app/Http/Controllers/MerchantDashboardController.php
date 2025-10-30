<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Vanilo\Foundation\Models\Order;
use Vanilo\Foundation\Models\Product;
use Vanilo\Foundation\Models\OrderItem;
use Carbon\Carbon;

class MerchantDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the merchant dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get summary statistics
        $totalRevenue = $this->getTotalRevenue();
        $totalOrders = $this->getTotalOrders();
        $totalProducts = $this->getTotalProducts();
        $recentOrders = $this->getRecentOrders(5);

        return view('merchant.dashboard', compact('totalRevenue', 'totalOrders', 'totalProducts', 'recentOrders', 'user'));
    }

    /**
     * Get transaction data for the chart (last 12 months).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTransactionData(Request $request)
    {
        $sellerId = Auth::id();
        
        // Get orders from this seller's products
        $transactions = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('products.user_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                DB::raw('DATE_FORMAT(orders.created_at, "%Y-%m") as month'),
                DB::raw('SUM(order_items.quantity * order_items.price) as revenue'),
                DB::raw('COUNT(DISTINCT orders.id) as order_count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Generate last 12 months with zero values if no data
        $last12Months = [];
        $monthlyData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $monthName = $date->format('M Y');
            
            $last12Months[] = $monthName;
            
            $data = $transactions->firstWhere('month', $monthKey);
            $monthlyData[] = [
                'revenue' => $data ? (int) $data->revenue : 0,
                'orders' => $data ? (int) $data->order_count : 0
            ];
        }

        return response()->json([
            'months' => $last12Months,
            'revenue' => array_column($monthlyData, 'revenue'),
            'orders' => array_column($monthlyData, 'orders')
        ]);
    }

    /**
     * Get product performance data (top 10 products).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductPerformanceData(Request $request)
    {
        $sellerId = Auth::id();

        $products = DB::table('products')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.user_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'products.name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_revenue', 'DESC')
            ->limit(10)
            ->get();

        return response()->json([
            'products' => $products->pluck('name')->toArray(),
            'quantities' => $products->pluck('total_quantity')->map(function($q) {
                return (int) $q;
            })->toArray(),
            'revenue' => $products->pluck('total_revenue')->map(function($r) {
                return (int) $r;
            })->toArray()
        ]);
    }

    /**
     * Get total revenue for this seller.
     *
     * @return float
     */
    private function getTotalRevenue()
    {
        $sellerId = Auth::id();
        
        $result = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.user_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->select(DB::raw('SUM(order_items.quantity * order_items.price) as total'))
            ->first();
        
        return $result ? (int) $result->total : 0;
    }

    /**
     * Get total orders count for this seller.
     *
     * @return int
     */
    private function getTotalOrders()
    {
        $sellerId = Auth::id();
        
        return DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('products.user_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->distinct('orders.id')
            ->count('orders.id') ?? 0;
    }

    /**
     * Get total products count for this seller.
     *
     * @return int
     */
    private function getTotalProducts()
    {
        $sellerId = Auth::id();
        
        return Product::where('user_id', $sellerId)->count();
    }

    /**
     * Get recent orders for this seller.
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    private function getRecentOrders($limit = 5)
    {
        $sellerId = Auth::id();
        
        return DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('products.user_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'orders.id',
                'orders.number',
                'orders.status',
                'orders.created_at',
                DB::raw('SUM(order_items.quantity * order_items.price) as order_total')
            )
            ->groupBy('orders.id', 'orders.number', 'orders.status', 'orders.created_at')
            ->orderBy('orders.created_at', 'DESC')
            ->limit($limit)
            ->get();
    }
}

