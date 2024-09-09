<?php

namespace Tests\Feature\Quotes;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ValidateQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_validate_without_signed_url(): void
    {
        $quote = Quote::factory()->create();

        $nonSignedUrl = URL::route('quotes.validate', ['quoteHash' => $quote->hash]);
        $response = $this->get($nonSignedUrl);

        $response->assertNotFound();

        $quote->refresh();
        $this->assertFalse($quote->validated);
    }

    public function test_can_validate_with_signed_url(): void
    {
        $quote = Quote::factory()->create();

        $response = $this->get($quote->temporaryValidationUrl());

        $response->assertRedirectToRoute('quotes.show', ['quoteHash' => $quote->hash]);

        $quote->refresh();
        $this->assertTrue($quote->validated);
    }

}
