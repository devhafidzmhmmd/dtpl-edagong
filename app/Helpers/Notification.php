<?php

namespace App\Helpers;

use App\User;
use App\Notification as NotificationModel;
use Vanilo\Foundation\Models\Order;

class Notification
{
    public static function createOrderNotifications(Order $order): void
    {
        // Get all merchants (UMKM sellers) who have products in this order
        $merchantIds = collect();
        
        foreach ($order->items as $item) {
            // Get the product and find its merchant
            $product = $item->product;
            if ($product && $product->user_id) {
                $merchantIds->push($product->user_id);
            }
        }

        // Remove duplicates
        $merchantIds = $merchantIds->unique();

        // Create notifications for each merchant
        foreach ($merchantIds as $merchantId) {
            $merchant = User::find($merchantId);
            
            // Only create notification for UMKM sellers
            if ($merchant && $merchant->isUmkmSeller()) {
                $orderData = [
                    'order_id' => $order->id,
                    'customer_name' => $order->billpayer->getName(),
                    'total' => $order->total(),
                    'items_count' => $order->items->count()
                ];

                NotificationModel::createOrderNotification($merchantId, $orderData);
            }
        }
    }
}