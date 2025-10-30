<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ProductHelpers;
use App\User;
use Illuminate\Http\Request;

class MerchantPublicController extends Controller
{
    /**
     * Store directory with search.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $category = trim((string) $request->get('category', ''));
        $city = trim((string) $request->get('city', ''));

        $merchants = User::query()
            ->where('user_type', 'umkm_seller')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('store_name', 'like', "%$q%")
                      ->orWhere('name', 'like', "%$q%")
                      ->orWhere('product_category', 'like', "%$q%")
                      ->orWhere('umkm_category', 'like', "%$q%")
                      ->orWhere('city', 'like', "%$q%");
                });
            })
            ->when($category !== '', function ($query) use ($category) {
                $query->where(function ($w) use ($category) {
                    $w->where('umkm_category', $category)
                      ->orWhere('product_category', 'like', "%$category%");
                });
            })
            ->when($city !== '', function ($query) use ($city) {
                $query->where('city', 'like', "%$city%");
            })
            ->latest()
            ->paginate(12);

        // Simple facets (distinct values)
        $categories = User::where('user_type', 'umkm_seller')
            ->whereNotNull('umkm_category')
            ->select('umkm_category')
            ->distinct()->pluck('umkm_category');

        $cities = User::where('user_type', 'umkm_seller')
            ->whereNotNull('city')
            ->select('city')
            ->distinct()->pluck('city');

        return view('store.index', compact('merchants', 'q', 'category', 'categories', 'city', 'cities'));
    }
    /**
     * Show a public store profile with its products.
     */
    public function show(User $merchant)
    {
        // Ensure it's a merchant
        if (!$merchant->isUmkmSeller()) {
            abort(404);
        }

        $products = $merchant->products()->latest()->paginate(12)->map(function ($product) {
            return ProductHelpers::overrideProduct($product);
        });

        return view('store.show', [
            'merchant' => $merchant,
            'products' => $products,
        ]);
    }
}


