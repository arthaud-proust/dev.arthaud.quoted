<?php

namespace Tests\Feature\Quotes;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_view_not_validated_quote(): void
    {
        $quote = Quote::factory()->notValidated()->create();

        $response = $this->get("/$quote->hash");

        $response->assertNotFound();
    }

    public function test_can_view_validated_quote(): void
    {
        $quote = Quote::factory()->validated()->create();

        $response = $this->get("/$quote->hash");

        $response->assertOk();
    }

    public function test_view_quote_update_its_view_count(): void
    {
        $quote = Quote::factory()->validated()->create([
            'views' => 0,
        ]);

        $response = $this->get("/$quote->hash");

        $response->assertOk();

        $this->assertEquals(1, $quote->fresh()->views);
    }
}
