<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use function abort;
use function redirect;

class ValidateQuoteController extends Controller
{
    public function __invoke(Request $request, Quote $quote)
    {
        if (!$request->hasValidSignature()) {
            abort(404);
        }

        $quote->update([
            'validated' => true,
        ]);

        return redirect()->route('quotes.show', ['quoteHash' => $quote->hash])->with(
            'success', 'La citation a bien été validée.'
        );
    }
}
