<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BuyerRegistrationController extends Controller
{
    /**
     * Show the buyer registration form
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.buyer-register');
    }

    /**
     * Handle buyer registration request
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
                'message' => 'Registrasi berhasil! Akun pembeli Anda telah dibuat.',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
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
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            
            // Personal Info
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'postal_code' => 'required|string|max:5|min:5',
            'address' => 'required|string|max:500',
            'area_landmark' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            
            // Terms and verification
            'terms_check' => 'required|accepted'
        ], [
            // Custom error messages in Indonesian
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Kata sandi harus diisi',
            'password.min' => 'Kata sandi minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
            'first_name.required' => 'Nama depan harus diisi',
            'last_name.required' => 'Nama belakang harus diisi',
            'phone.required' => 'Nomor telepon harus diisi',
            'phone.unique' => 'Nomor telepon sudah terdaftar',
            'postal_code.required' => 'Kode pos harus diisi',
            'postal_code.min' => 'Kode pos harus 5 digit',
            'postal_code.max' => 'Kode pos harus 5 digit',
            'address.required' => 'Alamat harus diisi',
            'city.required' => 'Kota harus diisi',
            'province.required' => 'Provinsi harus diisi',
            'terms_check.required' => 'Anda harus menyetujui syarat dan ketentuan',
            'terms_check.accepted' => 'Anda harus menyetujui syarat dan ketentuan'
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
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'username' => $data['email'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            
            // Personal info
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'postal_code' => $data['postal_code'],
            'address' => $data['address'],
            'area_landmark' => $data['area_landmark'] ?? null,
            'city' => $data['city'],
            'province' => $data['province'],
            
            // Status
            'is_verified' => true, // Buyers are auto-verified
            'user_type' => 'buyer'
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
                'message' => 'Email harus diisi'
            ], 400);
        }

        $exists = User::where('email', $email)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email sudah terdaftar' : 'Email tersedia'
        ]);
    }
}