<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_logout()
    {
        $this->withoutExceptionHandling();

        $john = User::factory()->create();
        $this->be($john);

        $this->delete('/logout')->assertRedirect(route('login'));

        $this->assertNull(auth()->user());
    }


    /** @test */
    public function only_an_authenticated_user_can_logout()
    {
        $this->delete('/logout')->assertRedirect('/login');
    }
}
