<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UmkmRegistrationController extends Controller
{
    /**
     * Handle UMKM registration request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            // Validate the request
            $validator = $this->validator($request->all());
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create user in database transaction
            $user = DB::transaction(function () use ($request) {
                return $this->create($request->all());
            });

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Akun Anda telah dibuat.',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'store_name' => $user->store_name
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // Account Details
            'multiStepsEmail' => 'required|string|email|max:255|unique:users,email',
            'multiStepsPass' => 'required|string|min:8|same:multiStepsConfirmPass',
            'multiStepsConfirmPass' => 'required|string|min:8',
            'multiStepsURL' => 'required|string|max:255',
            
            // Personal Info
            'multiStepsFirstName' => 'required|string|max:255',
            'multiStepsLastName' => 'required|string|max:255',
            'multiStepsMobile' => 'required|string|max:20|unique:users,phone',
            'multiStepsPincode' => 'required|string|max:5|min:5',
            'multiStepsAddress' => 'required|string|max:500',
            'multiStepsArea' => 'nullable|string|max:255',
            'multiStepsCity' => 'nullable|string|max:255',
            'multiStepsState' => 'nullable|string|max:255',
            
            // Store Info
            'umkmCategory' => 'required|in:mikro,kecil,menengah',
            'productCategory' => 'required|string|max:255',
            'storeOwnerName' => 'required|string|max:255',
            'ktpNumber' => 'required|string|max:16|min:16|unique:users,ktp_number',
            'storeDescription' => 'required|string|max:1000',
            
            // Terms and verification
            'termsCheck' => 'required|accepted',
            'verificationCheck' => 'required|accepted'
        ], [
            // Custom error messages in Indonesian
            'multiStepsEmail.required' => 'Email wajib diisi',
            'multiStepsEmail.email' => 'Format email tidak valid',
            'multiStepsEmail.unique' => 'Email sudah terdaftar',
            'multiStepsPass.required' => 'Kata sandi wajib diisi',
            'multiStepsPass.min' => 'Kata sandi minimal 8 karakter',
            'multiStepsPass.same' => 'Konfirmasi kata sandi tidak cocok',
            'multiStepsURL.required' => 'Nama toko wajib diisi',
            'multiStepsFirstName.required' => 'Nama depan wajib diisi',
            'multiStepsLastName.required' => 'Nama belakang wajib diisi',
            'multiStepsMobile.required' => 'Nomor telepon wajib diisi',
            'multiStepsMobile.unique' => 'Nomor telepon sudah terdaftar',
            'multiStepsPincode.required' => 'Kode pos wajib diisi',
            'multiStepsPincode.min' => 'Kode pos harus 5 digit',
            'multiStepsPincode.max' => 'Kode pos harus 5 digit',
            'multiStepsAddress.required' => 'Alamat wajib diisi',
            'multiStepsCity.required' => 'Kota wajib diisi',
            'multiStepsState.required' => 'Provinsi wajib diisi',
            'umkmCategory.required' => 'Kategori UMKM wajib dipilih',
            'umkmCategory.in' => 'Kategori UMKM tidak valid',
            'productCategory.required' => 'Kategori produk wajib dipilih',
            'storeOwnerName.required' => 'Nama pemilik toko wajib diisi',
            'ktpNumber.required' => 'Nomor KTP wajib diisi',
            'ktpNumber.min' => 'Nomor KTP harus 16 digit',
            'ktpNumber.max' => 'Nomor KTP harus 16 digit',
            'ktpNumber.unique' => 'Nomor KTP sudah terdaftar',
            'storeDescription.required' => 'Deskripsi toko wajib diisi',
            'termsCheck.required' => 'Anda harus menyetujui syarat dan ketentuan',
            'termsCheck.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
            'verificationCheck.required' => 'Anda harus menyatakan kebenaran informasi',
            'verificationCheck.accepted' => 'Anda harus menyatakan kebenaran informasi'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            // Basic user info
            'name' => $data['multiStepsFirstName'] . ' ' . $data['multiStepsLastName'],
            'username' => $data['multiStepsEmail'],
            'email' => $data['multiStepsEmail'],
            'password' => Hash::make($data['multiStepsPass']),
            
            // Personal info
            'first_name' => $data['multiStepsFirstName'],
            'last_name' => $data['multiStepsLastName'],
            'phone' => $data['multiStepsMobile'],
            'postal_code' => $data['multiStepsPincode'],
            'address' => $data['multiStepsAddress'],
            'area_landmark' => $data['multiStepsArea'] ?? null,
            'city' => $data['multiStepsCity'] ?? null,
            'province' => $data['multiStepsState'] ?? null,
            
            // Store info
            'store_name' => $data['multiStepsURL'],
            'umkm_category' => $data['umkmCategory'],
            'product_category' => $data['productCategory'],
            'store_owner_name' => $data['storeOwnerName'],
            'ktp_number' => $data['ktpNumber'],
            'store_description' => $data['storeDescription'],
            
            // Status
            'is_verified' => false,
            'user_type' => 'umkm_seller'
        ]);
    }

    /**
     * Check if email is available
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        
        if (!$email) {
            return response()->json([
                'available' => false,
                'message' => 'Email tidak boleh kosong'
            ], 400);
        }

        $exists = User::where('email', $email)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email sudah terdaftar' : 'Email tersedia'
        ]);
    }

}
