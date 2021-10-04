<?php

namespace Tests\Feature\Models;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_contacts()
    {
        $user = User::factory()->has(Contact::factory()->count(3), 'contacts')->create();

        $this->assertCount(3, $user->contacts);
    }
}
