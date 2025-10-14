<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BuyerProfileController extends Controller
{
    /**
     * Show the buyer profile page
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        
        // Ensure only buyers can access this page
        if (!$user->isBuyer()) {
            abort(403, 'Unauthorized access');
        }
        
        return view('buyer.profile', compact('user'));
    }

    /**
     * Update the buyer profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Ensure only buyers can update their profile
        if (!$user->isBuyer()) {
            abort(403, 'Unauthorized access');
        }

        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users')->ignore($user->id),
            ],
            'postal_code' => 'required|string|max:5|min:5',
            'address' => 'required|string|max:500',
            'area_landmark' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ], [
            'first_name.required' => 'Nama depan harus diisi',
            'last_name.required' => 'Nama belakang harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'phone.required' => 'Nomor telepon harus diisi',
            'phone.unique' => 'Nomor telepon sudah digunakan',
            'postal_code.required' => 'Kode pos harus diisi',
            'postal_code.min' => 'Kode pos harus 5 digit',
            'postal_code.max' => 'Kode pos harus 5 digit',
            'address.required' => 'Alamat harus diisi',
            'city.required' => 'Kota harus diisi',
            'province.required' => 'Provinsi harus diisi',
            'profile_picture.image' => 'File harus berupa gambar',
            'profile_picture.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
        ]);

        // Validate current password if new password is provided
        if ($request->filled('new_password')) {
            if (!$request->filled('current_password') || !Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak benar']);
            }
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Store new profile picture
            $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
            $validatedData['profile_picture'] = $profilePicturePath;
        }

        // Update password if provided
        if ($request->filled('new_password')) {
            $validatedData['password'] = Hash::make($request->new_password);
        }

        // Update name field
        $validatedData['name'] = $validatedData['first_name'] . ' ' . $validatedData['last_name'];

        // Remove password fields from validated data if not updating password
        unset($validatedData['current_password'], $validatedData['new_password'], $validatedData['new_password_confirmation']);

        // Update user
        $user->update($validatedData);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}