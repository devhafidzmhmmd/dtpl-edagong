<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Vanilo\Foundation\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     */
    public function creating(Product $product): void
    {
        // Automatically set user_id when creating a product
        if (Auth::check() && Auth::user()->isUmkmSeller()) {
            $product->user_id = Auth::id();
        }
    }

    /**
     * Handle the Product "updating" event.
     */
    public function updating(Product $product): void
    {
        // If user_id is null and user is UMKM seller, set it
        if (Auth::check() && Auth::user()->isUmkmSeller() && is_null($product->user_id)) {
            $product->user_id = Auth::id();
        }
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        // Log or perform any additional actions after product creation
        if ($product->user_id) {
            \Log::info("Product '{$product->name}' created by user ID: {$product->user_id}");
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        // Log or perform any additional actions after product update
        if ($product->user_id) {
            \Log::info("Product '{$product->name}' updated by user ID: {$product->user_id}");
        }
    }
}