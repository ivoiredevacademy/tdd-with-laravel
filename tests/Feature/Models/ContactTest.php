<?php

namespace Tests\Feature\Models;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_an_owner()
    {
        $contact = Contact::factory()->create();

        $this->assertInstanceOf(User::class, $contact->owner);
    }
}
