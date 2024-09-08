<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use function view;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'randomQuote' => Quote::inRandomOrder()->first(),
            'lastQuotes' => Quote::latest('created_at')->take(4)->get(),
        ]);
    }
}
