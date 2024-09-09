<?php

namespace Tests\Feature\Quotes;

use App\Models\User;
use App\Notifications\NewQuote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class CreateQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_quote(): void
    {
        $response = $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'email' => 'john.doe@email.com',
        ]);

        $response->assertRedirect('/quotes');

        $this->assertDatabaseHas('quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
        ]);
    }

    public function test_created_quote_is_not_validated(): void
    {
        $response = $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'email' => 'john.doe@email.com',
        ]);

        $response->assertRedirect('/quotes');

        $this->assertDatabaseHas('quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'validated' => false,
        ]);
    }

    public function test_create_quote_will_link_user_with_same_email(): void
    {
        $user = User::factory()->create([
            'email' => 'john.doe@email.com',
        ]);

        $response = $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'email' => 'john.doe@email.com',
        ]);

        $response->assertRedirect('/quotes');

        $this->assertDatabaseHas('quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'user_id' => $user->id,
        ]);
    }

    public function test_create_quote_will_create_user_if_not_found(): void
    {
        $response = $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'email' => 'john.doe@email.com',
        ]);

        $response->assertRedirect('/quotes');

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@email.com',
        ]);
    }

    public function test_create_quote_will_send_notifiaction_to_admins(): void
    {
        Notification::fake();

        $admin = User::factory()->create([
            'admin' => true,
        ]);

        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'email' => 'john.doe@email.com',
        ]);

        Notification::assertSentTo($admin, NewQuote::class);
    }
}
