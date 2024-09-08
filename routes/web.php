<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::resource('quotes', QuoteController::class)->only('index', 'create', 'store', 'show');
