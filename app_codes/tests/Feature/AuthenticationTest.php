<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_open_the_login_and_registration_pages(): void
    {
        $this->get('/login')->assertOk()->assertSee('Phone Number');
        $this->get('/register')->assertOk()->assertSee('Create your home');
    }

    public function test_a_user_can_register_with_a_phone_number(): void
    {
        $response = $this->post('/register', [
            'name' => 'Mina',
            'phone' => '0917 123 4567',
            'password' => 'pawtalaan-secret',
            'password_confirmation' => 'pawtalaan-secret',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['phone' => '+639171234567']);
        $this->get('/home')->assertOk()->assertSee('Your PawTalaan');
    }

    public function test_a_user_can_log_in_and_log_out(): void
    {
        User::factory()->create(['phone' => '+639181234567', 'password' => 'pawtalaan-secret']);

        $this->post('/login', ['phone' => '09181234567', 'password' => 'pawtalaan-secret'])
            ->assertRedirect('/home');
        $this->assertAuthenticated();

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }
}
