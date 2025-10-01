<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Basic user fields
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('first_name')->nullable()->after('username');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone')->unique()->nullable()->after('last_name');
            
            // Address fields
            $table->string('postal_code', 5)->nullable()->after('phone');
            $table->text('address')->nullable()->after('postal_code');
            $table->string('area_landmark')->nullable()->after('address');
            $table->string('city')->nullable()->after('area_landmark');
            $table->string('province')->nullable()->after('city');
            
            // Store/UMKM fields
            $table->string('store_name')->nullable()->after('province');
            $table->enum('umkm_category', ['mikro', 'kecil', 'menengah'])->nullable()->after('store_name');
            $table->string('product_category')->nullable()->after('umkm_category');
            $table->string('store_owner_name')->nullable()->after('product_category');
            $table->string('ktp_number', 16)->unique()->nullable()->after('store_owner_name');
            $table->text('store_description')->nullable()->after('ktp_number');
            
            // Status fields
            $table->boolean('is_verified')->default(false)->after('store_description');
            $table->enum('user_type', ['customer', 'umkm_seller', 'admin'])->default('customer')->after('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'first_name',
                'last_name',
                'phone',
                'postal_code',
                'address',
                'area_landmark',
                'city',
                'province',
                'store_name',
                'umkm_category',
                'product_category',
                'store_owner_name',
                'ktp_number',
                'store_description',
                'is_verified',
                'user_type'
            ]);
        });
    }
};
