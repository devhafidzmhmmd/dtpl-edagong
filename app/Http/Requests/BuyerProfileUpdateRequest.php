<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuyerProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isBuyer();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = auth()->user();
        
        return [
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
        ];
    }
}