<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_a_user_gives_his_credentials_he_is_authenticated()
    {
        $this->withoutExceptionHandling();

        $john = User::factory()->create();
        $credentials = [
            'email' => $john->email,
            'password' => 'password'
        ];

        $this->post('/login', $credentials)->assertRedirect(route('dashboard'));

        $this->assertEquals(auth()->id(), $john->id);
    }

    /** @test */
    public function to_be_authenticated_a_user_must_give_existing_email()
    {
        $this->post('/login', ["email" => "fake@email.com", "password" => "Hello-wolrd"])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function to_be_authenticated_a_user_must_give_a_valid_email()
    {
        $this->post('/login', ["email" => "fake", "password" => "Hello-wolrd"])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function authentication_requires_email()
    {
        $this->post('/login', ["email" => "", "password" => "Hello-wolrd"])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function authentication_requires_password()
    {
        $this->post('/login', ["email" => "", "password" => ""])
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function to_be_authenticated_a_user_should_give_exact_password()
    {
        $john = User::factory()->create();

        $credentials = [
            'email' => $john->email,
            'password' => 'fake-password'
        ];

        $this->post('/login', $credentials)->assertSessionHasErrors('email');
    }

    /** @test */
    public function only_unauthenticated_can_access_to_the_login_page()
    {
        $this->actingAs(User::factory()->create())
            ->get('/login')
            ->assertRedirect('/dashboard');
    }
}
