<?php

namespace Tests\Feature\Quotes;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ViewQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_quote(): void
    {
        $quote = Quote::factory()->create();

        $response = $this->get("/quotes/$quote->id");

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_view_quote_update_its_view_count(): void
    {
        $quote = Quote::factory()->create([
            'views' => 0,
        ]);

        $response = $this->get("/quotes/$quote->id");

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEquals(1, $quote->fresh()->views);
    }
}
