<?php

namespace App\Http\Helpers;

use Illuminate\Foundation\Auth\User;
use Vanilo\Foundation\Models\Product;

class ProductHelpers
{
    public static function overrideProduct(Product $product)
    {
        if ($product->propertyValues->contains('value', 'makanan')) {
            $product->after_discount = $product->price - ($product->price * 0.2);
            $product->discount = true;
        }
        $product->merchant = User::find($product->user_id);
        $product->price_display = 'Rp. ' . number_format($product->price, 0, ',', '.');
        $product->after_discount_display = 'Rp. ' . number_format($product->after_discount, 0, ',', '.');
        return $product;
    }
}