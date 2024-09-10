<?php

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_works_if_no_quote(): void
    {
        $response = $this->get("/");

        $response->assertOk();
    }

    public function test_only_display_validated_quotes(): void
    {
        $validated = Quote::factory()->validated()->create();

        $notValidated = Quote::factory()->notValidated()->create();

        $response = $this->get("/");

        $response->assertSee($validated->content);
        $response->assertDontSee($notValidated->content);
    }
}
