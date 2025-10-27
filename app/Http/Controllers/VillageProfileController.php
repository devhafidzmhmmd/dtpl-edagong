<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Vanilo\Foundation\Models\Product;
use Vanilo\Foundation\Models\Order;
use Illuminate\Support\Facades\DB;

class VillageProfileController extends Controller
{
    /**
     * Display the village profile landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get UMKM members (verified sellers)
        $umkmMembers = User::where('user_type', 'umkm_seller')
            ->where('is_verified', true)
            ->whereNotNull('store_logo')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Get featured products (products from verified UMKM)
        $verifiedUmkmIds = User::where('user_type', 'umkm_seller')
            ->where('is_verified', true)
            ->pluck('id');
        
        $featuredProducts = Product::whereIn('user_id', $verifiedUmkmIds)
            ->whereNotNull('user_id')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Get statistics
        $stats = [
            'total_umkm' => User::where('user_type', 'umkm_seller')->count(),
            'total_products' => Product::whereNotNull('user_id')->count(),
            'verified_umkm' => User::where('user_type', 'umkm_seller')->where('is_verified', true)->count(),
        ];

        // Get total orders (for impact metrics)
        $totalOrders = DB::table('orders')
            ->where('status', '!=', 'cancelled')
            ->count();

        return view('village.profile', compact('umkmMembers', 'featuredProducts', 'stats', 'totalOrders'));
    }
}

