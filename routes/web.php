<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Quote\QuoteController;
use App\Http\Controllers\Quote\ValidateQuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('quotes', QuoteController::class)->only('index', 'create', 'store');
Route::get('/{quoteHash}', [QuoteController::class, 'show'])->name('quotes.show');
Route::get('/{quoteHash}/validate', ValidateQuoteController::class)->name('quotes.validate');
