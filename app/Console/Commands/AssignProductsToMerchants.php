<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Vanilo\Foundation\Models\Product;

class AssignProductsToMerchants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:assign-to-merchants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign existing products to UMKM sellers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Assigning products to UMKM sellers...');

        // Get all UMKM sellers
        $merchants = User::where('user_type', 'umkm_seller')->get();
        
        if ($merchants->isEmpty()) {
            $this->error('No UMKM sellers found. Please create some UMKM sellers first.');
            return 1;
        }

        // Get all products without user_id
        $products = Product::whereNull('user_id')->get();
        
        if ($products->isEmpty()) {
            $this->info('No unassigned products found.');
            return 0;
        }

        $this->info("Found {$merchants->count()} merchants and {$products->count()} unassigned products.");

        // Assign products to merchants
        $assignedCount = 0;
        foreach ($products as $index => $product) {
            $merchant = $merchants[$index % $merchants->count()];
            $product->user_id = $merchant->id;
            $product->save();
            $assignedCount++;
            
            $this->line("Assigned '{$product->name}' to merchant '{$merchant->store_name}' ({$merchant->email})");
        }

        $this->info("Successfully assigned {$assignedCount} products to merchants.");
        return 0;
    }
}