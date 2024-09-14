<?php

namespace Tests\Feature\Quotes\Creation;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NormalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_remove_english_quotation_marks(): void
    {
        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => '"Bob said: "Hello""',
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $this->assertEquals(
            'Bob said: Hello',
            Quote::first()->content
        );
    }

    public function test_remove_french_quotation_marks(): void
    {
        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => '«Bob said: «Hello»»',
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $this->assertEquals(
            'Bob said: Hello',
            Quote::first()->content
        );
    }

    public function test_remove_leading_dot(): void
    {
        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Bob said: Hello.',
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $this->assertEquals(
            'Bob said: Hello',
            Quote::first()->content
        );
    }

    public function test_remove_leading_exclamation_dot(): void
    {
        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Bob said: Hello!',
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $this->assertEquals(
            'Bob said: Hello',
            Quote::first()->content
        );
    }

    public function test_remove_leading_question_mark(): void
    {
        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'Bob said: Hello?',
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $this->assertEquals(
            'Bob said: Hello',
            Quote::first()->content
        );
    }

    public function test_upper_first_letter(): void
    {
        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => 'bob said: Hello',
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $this->assertEquals(
            'Bob said: Hello',
            Quote::first()->content
        );
    }

    public function test_squish_spaces(): void
    {
        $this->post('/quotes', [
            'author' => 'John doe',
            'content' => '      Bob     said:     Hello     ',
            'source' => 'https://example.com',
            'email' => 'john.doe@email.com',
        ]);

        $this->assertEquals(
            'Bob said: Hello',
            Quote::first()->content
        );
    }
}
