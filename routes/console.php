<?php

use App\Models\Quote;
use App\Models\User;
use Hashids\Hashids;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('csv:load', function () {
    SimpleExcelReader::create(Storage::path('backup.csv'))->getRows()->each(function (array $quote) {
        $user = User::firstOrCreate(
            [
                'email' => $quote['user_email'],
            ],
            [
                'name' => $quote['user_name'],
                'email' => $quote['user_email'],
                'password' => Str::random(32),
            ],
        );

        Quote::create([
            'user_id' => $user->id,
            'author' => $quote['author'],
            'content' => $quote['content'],
            'views' => $quote['views'],
            'validated' => true,
            'created_at' => $quote['created_at'],
            'updated_at' => $quote['updated_at'],
        ]);
    });
});

Artisan::command('csv:generate', function () {
    $usersById = [];
    SimpleExcelReader::create(Storage::path('users.csv'))->getRows()->each(function (array $user) use (&$usersById) {
        $usersById[$user['id']] = [
            'user_name' => $user['name'],
            'user_email' => $user['email'],
        ];
    });
    $hashids = new Hashids('', 5);

    $quotes = SimpleExcelReader::create(Storage::path('quotes.csv'))->getRows()->map(callback: function (array $quote) use (&$usersById, &$hashids) {
        $userId = $hashids->decode($quote['user'])[0];
        $user = $usersById[$userId];
        if (!$user) {
            dd($userId, $quote);
        }

        return [
            ...$quote,
            ...$user,
        ];
    });

    SimpleExcelWriter::create(Storage::path('backup.csv'))
        ->addRows($quotes);
});
