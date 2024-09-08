<?php

namespace Tests\Feature\Quotes;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
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

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('quotes', [
            'author' => 'John doe',
            'content' => 'Lorem ipsum',
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

        $response->assertStatus(Response::HTTP_FOUND);

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

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@email.com',
        ]);
    }
}
