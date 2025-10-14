<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the user_type enum to include 'buyer'
        DB::statement("ALTER TABLE users MODIFY COLUMN user_type ENUM('customer', 'umkm_seller', 'admin', 'buyer') DEFAULT 'customer'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE users MODIFY COLUMN user_type ENUM('customer', 'umkm_seller', 'admin') DEFAULT 'customer'");
        
        // Update any 'buyer' records to 'customer' before reverting
        DB::table('users')->where('user_type', 'buyer')->update(['user_type' => 'customer']);
    }
};