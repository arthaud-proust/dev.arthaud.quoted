<?php

namespace App\Providers;

use App\Models\Quote;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));

        Route::bind('quoteHash', function (string $hash) {
            try {
                return Quote::where('id', Quote::idFromHash($hash))->firstOrFail();
            } catch (Exception $e) {
                abort(404);
            }
        });
    }
}
