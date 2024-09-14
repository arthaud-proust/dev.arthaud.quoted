<?php

namespace App\Normalizers;

use Illuminate\Support\Str;
use function str_ends_with;
use function str_starts_with;
use function substr;

class QuoteContentNormalizer
{
    private function trim($content, $char)
    {
        if (str_starts_with($content, $char)) {
            $content = substr($content, 1);
        }

        if (str_ends_with($content, $char)) {
            $content = substr($content, 0, -1);
        }

        return $content;
    }

    public function normalize(string $quoteContent): string
    {
        $quoteContent = Str::squish($quoteContent);
        $quoteContent = Str::replace(['"', '«', '»'], '', $quoteContent);
        $quoteContent = Str::rtrim($quoteContent, '.!?');
        $quoteContent = Str::transliterate($quoteContent);
        $quoteContent = Str::ucfirst($quoteContent);

        return $quoteContent;
    }
}
