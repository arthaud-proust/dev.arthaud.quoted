<?php

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_only_display_validated_quotes(): void
    {
        $validated = Quote::factory()->create([
            'validated' => true,
        ]);

        $notValidated = Quote::factory()->create([
            'validated' => false,
        ]);

        $response = $this->get("/");

        $response->assertSee($validated->content);
        $response->assertDontSee($notValidated->content);
    }
}
