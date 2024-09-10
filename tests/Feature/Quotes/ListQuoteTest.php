<?php

namespace Tests\Feature\Quotes;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_display_validated_quotes(): void
    {
        $validated = Quote::factory()->validated()->create();

        $notValidated = Quote::factory()->notValidated()->create();

        $response = $this->get("/quotes");

        $response->assertSee($validated->content);
        $response->assertDontSee($notValidated->content);
    }
}
