<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use function view;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'quotes' => Quote::take(4),
        ]);
    }
}
