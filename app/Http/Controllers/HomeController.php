<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use function view;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'randomQuote' => Quote::validated()->inRandomOrder()->first(),
            'lastQuotes' => Quote::validated()->latest('created_at')->take(4)->get(),
        ]);
    }
}
