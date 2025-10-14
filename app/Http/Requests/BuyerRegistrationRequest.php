<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyerRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
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
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
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
        ];
    }
}