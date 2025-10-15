<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Vanilo\Foundation\Models\MasterProduct;

class MasterProductObserver
{
    /**
     * Handle the MasterProduct "creating" event.
     */
    public function creating(MasterProduct $masterProduct): void
    {
        // Automatically set user_id when creating a master product
        if (Auth::check() && Auth::user()->isUmkmSeller()) {
            $masterProduct->user_id = Auth::id();
        }
    }

    /**
     * Handle the MasterProduct "updating" event.
     */
    public function updating(MasterProduct $masterProduct): void
    {
        // If user_id is null and user is UMKM seller, set it
        if (Auth::check() && Auth::user()->isUmkmSeller() && is_null($masterProduct->user_id)) {
            $masterProduct->user_id = Auth::id();
        }
    }

    /**
     * Handle the MasterProduct "created" event.
     */
    public function created(MasterProduct $masterProduct): void
    {
        // Log or perform any additional actions after master product creation
        if ($masterProduct->user_id) {
            \Log::info("Master Product '{$masterProduct->name}' created by user ID: {$masterProduct->user_id}");
        }
    }

    /**
     * Handle the MasterProduct "updated" event.
     */
    public function updated(MasterProduct $masterProduct): void
    {
        // Log or perform any additional actions after master product update
        if ($masterProduct->user_id) {
            \Log::info("Master Product '{$masterProduct->name}' updated by user ID: {$masterProduct->user_id}");
        }
    }
}