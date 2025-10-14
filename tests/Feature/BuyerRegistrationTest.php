<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BuyerRegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test buyer registration form can be displayed
     */
    public function test_buyer_registration_form_can_be_displayed(): void
    {
        $response = $this->get(route('buyer.register.show'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.buyer-register');
        $response->assertSee('Daftar Sebagai Pembeli');
    }

    /**
     * Test buyer can register with valid data
     */
    public function test_buyer_can_register_with_valid_data(): void
    {
        $userData = [
            'email' => 'buyer@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '6281234567890',
            'postal_code' => '12345',
            'address' => 'Jl. Test No. 123',
            'city' => 'Jakarta',
            'province' => 'DKI',
            'terms_check' => true
        ];

        $response = $this->postJson(route('buyer.register'), $userData);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Registrasi berhasil! Akun pembeli Anda telah dibuat.'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'buyer@example.com',
            'user_type' => 'buyer',
            'is_verified' => true
        ]);
    }

    /**
     * Test buyer registration fails with invalid data
     */
    public function test_buyer_registration_fails_with_invalid_data(): void
    {
        $userData = [
            'email' => 'invalid-email',
            'password' => '123',
            'password_confirmation' => '456',
            'first_name' => '',
            'last_name' => '',
            'phone' => '',
            'postal_code' => '123',
            'address' => '',
            'city' => '',
            'province' => '',
            'terms_check' => false
        ];

        $response = $this->postJson(route('buyer.register'), $userData);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Validasi gagal'
        ]);
    }

    /**
     * Test email availability check
     */
    public function test_email_availability_check(): void
    {
        // Test with non-existing email
        $response = $this->postJson(route('buyer.check-email'), [
            'email' => 'new@example.com'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'available' => true,
            'message' => 'Email tersedia'
        ]);

        // Create a user first
        User::factory()->create(['email' => 'existing@example.com']);

        // Test with existing email
        $response = $this->postJson(route('buyer.check-email'), [
            'email' => 'existing@example.com'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'available' => false,
            'message' => 'Email sudah terdaftar'
        ]);
    }

    /**
     * Test buyer user type is set correctly
     */
    public function test_buyer_user_type_is_set_correctly(): void
    {
        $userData = [
            'email' => 'buyer@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '6281234567890',
            'postal_code' => '12345',
            'address' => 'Jl. Test No. 123',
            'city' => 'Jakarta',
            'province' => 'DKI',
            'terms_check' => true
        ];

        $this->postJson(route('buyer.register'), $userData);

        $user = User::where('email', 'buyer@example.com')->first();
        
        $this->assertTrue($user->isBuyer());
        $this->assertFalse($user->isUmkmSeller());
        $this->assertTrue($user->isVerified());
    }
}