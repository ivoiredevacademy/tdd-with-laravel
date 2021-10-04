<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected $auth;

    protected function setUp(): void
    {
        parent::setUp();

        $this->auth = User::factory()->create();
    }

    protected function contactAttributes($overrides = []) : array
    {
        $contactAttributes =  [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => '0102030405',
            'address' => $this->faker->sentence
        ];

        return array_merge($contactAttributes, $overrides);
    }

    /** @test */
    public function an_authenticated_can_create_contacts()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->auth)
            ->post('contacts', $formAttributes = $this->contactAttributes())
            ->assertSessionHas('success')
            ->assertRedirect('dashboard');

        $this->assertDatabaseHas('contacts', $formAttributes);
    }

    /** @test */
    public function only_authenticated_user_can_create_a_contact()
    {
        $this->post('contacts', $this->contactAttributes())
            ->assertRedirect('/login');
    }

    /** @test */
    public function contact_creation_requires_a_name()
    {
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['name' => null]))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function contact_creation_requires_a_valid_email()
    {
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['email' => null]))
            ->assertSessionHasErrors('email');

        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['email' => 'bad-format-email']))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function contact_creation_requires_10_digits_phone()
    {
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['phone' => null]))
            ->assertSessionHasErrors('phone');

        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['phone' => 'gpejghptjghetp']))
            ->assertSessionHasErrors('phone');

        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['phone' => '010203040']))
            ->assertSessionHasErrors('phone');

        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['phone' => '0102030405']))
            ->assertSessionHas('success');
    }

    /** @test */
    public function contact_creation_requires_an_address()
    {
        $this->actingAs($this->auth)
            ->post('/contacts', $this->contactAttributes(['address' => null]))
            ->assertSessionHasErrors('address');
    }

    /** @test */
    public function an_authenticated_can_access_to_his_contacts()
    {
        $this->be($this->auth);

        Contact::factory()->create(['user_id' => $this->auth->id, 'name' => 'Jeff']);
        Contact::factory()->create(['user_id' => $this->auth->id, 'name' => 'Jane']);

        $this->get('/dashboard')
            ->assertSee('Jeff')
            ->assertSee('Jane');
    }

    /** @test */
    public function an_authenticated_can_paginate_through_his_contacts()
    {
        $this->be($this->auth);

        Contact::factory()->create(['user_id' => $this->auth->id, 'name' => 'Jeff', 'created_at' => now()->subMinutes(2)]);
        Contact::factory()->count(15)->create(['user_id' => $this->auth->id]);
        Contact::factory()->create(['user_id' => $this->auth->id, 'name' => 'Jane', 'created_at' => now()->addMinutes(2)]);

        $this->get('/dashboard')
            ->assertSee('Jane')
            ->assertDontSee('Jeff');

        $this->get('/dashboard?page=2')
            ->assertSee('Jeff')
            ->assertDontSee('Jane');
    }

    /** @test */
    public function an_authenticated_user_can_edit_a_contact()
    {
        $this->withoutExceptionHandling();

        $john = Contact::factory()->create(['user_id' => $this->auth->id]);

        $this->actingAs($this->auth)
            ->patch(route('contacts.update', $john), $formAttributes = $this->contactAttributes())
            ->assertSessionHas('success')
            ->assertRedirect('dashboard');

        $this->assertDatabaseHas('contacts', $formAttributes);

        $john = $john->fresh();
        $this->assertEquals($john->name, $formAttributes['name']);
    }

    /** @test */
    public function an_authenticated_user_can_edit_only_his_contact()
    {
        $john = Contact::factory()->create();

        $this->actingAs($this->auth)
            ->patch(route('contacts.update', $john), $formAttributes = $this->contactAttributes())
            ->assertForbidden();

    }

    /** @test */
    public function contact_update_requires_a_name()
    {
        $john = Contact::factory()->create(['user_id' => $this->auth->id]);

        $this->actingAs($this->auth)
            ->put(route('contacts.update', $john), $this->contactAttributes(['name' => null]))
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function contact_update_requires_a_valid_email()
    {
        $john = Contact::factory()->create(['user_id' => $this->auth->id]);

        $this->actingAs($this->auth)
            ->put(route('contacts.update', $john), $this->contactAttributes(['email' => null]))
            ->assertSessionHasErrors('email');

        $this->actingAs($this->auth)
            ->put(route('contacts.update', $john),  $this->contactAttributes(['email' => 'bad-format-email']))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function contact_update_requires_10_digits_phone()
    {
        $john = Contact::factory()->create(['user_id' => $this->auth->id]);

        $this->actingAs($this->auth)
            ->put(route('contacts.update', $john),  $this->contactAttributes(['phone' => null]))
            ->assertSessionHasErrors('phone');

        $this->actingAs($this->auth)
            ->put(route('contacts.update', $john),  $this->contactAttributes(['phone' => 'gpejghptjghetp']))
            ->assertSessionHasErrors('phone');

        $this->actingAs($this->auth)
            ->put(route('contacts.update', $john),  $this->contactAttributes(['phone' => '010203040']))
            ->assertSessionHasErrors('phone');

        $this->actingAs($this->auth)
            ->put(route('contacts.update', $john), $this->contactAttributes(['phone' => '0102030405']))
            ->assertSessionHas('success');
    }

    /** @test */
    public function contact_update_requires_an_address()
    {
        $john = Contact::factory()->create(['user_id' => $this->auth->id]);

        $this->actingAs($this->auth)
            ->put(route('contacts.update', $john), $this->contactAttributes(['address' => null]))
            ->assertSessionHasErrors('address');
    }

    /** @test */
    public function an_authenticated_user_can_delete_his_contact()
    {
        $this->withoutExceptionHandling();

        $john = Contact::factory()->create(['user_id' => $this->auth->id]);

        $this->actingAs($this->auth)
            ->delete(route('contacts.destroy', $john))
            ->assertSessionHas('success')
            ->assertRedirect('/dashboard');

        $this->assertDatabaseMissing('contacts', [
            'id' => $john->id
        ]);
    }

    /** @test */
    public function an_authenticated_user_can_delete_only_his_contact()
    {
        $john = Contact::factory()->create();

        $this->actingAs($this->auth)
            ->delete(route('contacts.destroy', $john))
            ->assertForbidden();

        $this->assertDatabaseHas('contacts', [
            'id' => $john->id
        ]);
    }

    /** @test */
    public function an_authenticated_can_see_his_contact_info()
    {
        $this->withoutExceptionHandling();

        $john = Contact::factory()->create(['user_id' => $this->auth->id]);

        $this->actingAs($this->auth)
            ->get(route('contacts.edit', $john))
            ->assertSee($john->name)
            ->assertSee($john->email)
            ->assertSee($john->phone)
            ->assertSee($john->address);
    }
}
