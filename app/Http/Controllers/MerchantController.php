<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function profile()
    {
        return view('merchant.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_owner_name' => 'nullable|string|max:255',
            'umkm_category' => 'nullable|string|max:255',
            'store_description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'area_landmark' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
            'product_category' => 'nullable|string|max:255',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        $user = Auth::user();
        
        // Handle file upload
        if ($request->hasFile('store_logo')) {
            // Delete old logo if exists
            if ($user->store_logo && Storage::disk('public')->exists($user->store_logo)) {
                Storage::disk('public')->delete($user->store_logo);
            }
            
            // Store new logo
            $logoPath = $request->file('store_logo')->store('store-logos', 'public');
            $user->store_logo = $logoPath;
        }

        // Update user data
        $user->update([
            'store_name' => $request->store_name,
            'store_owner_name' => $request->store_owner_name,
            'umkm_category' => $request->umkm_category,
            'store_description' => $request->store_description,
            'address' => $request->address,
            'area_landmark' => $request->area_landmark,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'product_category' => $request->product_category,
        ]);

        return redirect()->route('merchant.profile')->with('success', 'Store profile updated successfully!');
    }
}