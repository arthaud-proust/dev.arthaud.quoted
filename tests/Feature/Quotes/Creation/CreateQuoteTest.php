<?php

namespace Tests\Feature\Quotes\Creation;

use App\Jobs\NotifyNewQuote;
use App\Models\Quote;
use App\Models\User;
use App\Notifications\NewQuote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
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
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $response->assertRedirect('/quotes');

        $this->assertDatabaseHas('quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'source' => 'https://example.com',
        ]);
    }

    public function test_cannot_create_quote_that_already_exists(): void
    {
        Quote::factory()->create([
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'source' => 'https://example.com',
        ]);

        $response = $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $response->assertSessionHasErrors('content');

        $this->assertDatabaseCount('quotes', 1);
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

    public function test_create_quote_will_send_notification_to_admins(): void
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

    public function test_create_quote_notify_after_response(): void
    {
        Bus::fake();

        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
            'email' => 'john.doe@email.com',
        ]);

        Bus::assertDispatchedAfterResponse(NotifyNewQuote::class);
    }
}
