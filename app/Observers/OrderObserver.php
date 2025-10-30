<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Konekt\AppShell\Models\User;
use Vanilo\Foundation\Models\Order;
use App\Notification as NotificationModel;


class OrderObserver
{
    public function updating(Order $order): void
    {
        $billpayer = $order->billpayer;
        $user = User::where('email', $billpayer->email)->first();
        if ($user) {
            NotificationModel::createOrderStatusUpdatedNotification($user->id, $order);
        }
    }
}