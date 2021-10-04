<?php

namespace Tests\Feature;

use App\Mail\Message;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function formAttributes(array $contacts = [], array $overrides = []): array
    {
        $contacts = $contacts ?: Contact::factory()->count(2)->create()->pluck('id')->toArray();

        $formAttributes = [
            'title' => $this->faker->name(),
            'contacts' => $contacts,
            'message' => $this->faker->sentence
        ];

        return array_merge($formAttributes, $overrides);
    }

    public function test_an_authenticated_user_can_send_messages()
    {
        $this->withoutExceptionHandling();

        Mail::fake();

        $contacts = Contact::factory()->count(2)->create(['user_id' => $this->auth->id]);
        $contactIds = $contacts->pluck('id')->toArray();


        $this->actingAs($this->auth)
            ->post(route('messages.send'), $this->formAttributes($contactIds))
            ->assertRedirect('/dashboard')
            ->assertSessionHas('success');


        Mail::assertSent(Message::class);
        Mail::assertSent(Message::class, fn ($mailable) => $mailable->hasTo($contacts[0]->email));
        Mail::assertSent(Message::class, fn ($mailable) => $mailable->hasTo($contacts[1]->email));
    }

    public function test_an_authenticated_user_can_send_messages_only_to_his_contacts()
    {
        $this->withoutExceptionHandling();

        Mail::fake();

        $contacts = Contact::factory()->count(2)->create();
        $contactIds = $contacts->pluck('id')->toArray();

        $this->actingAs($this->auth)
            ->post(route('messages.send'), $this->formAttributes($contactIds))
            ->assertRedirect('/dashboard')
            ->assertSessionHas('success');

        Mail::assertNotSent(Message::class);
    }
}
