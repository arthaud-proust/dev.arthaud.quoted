<?php

namespace App\Jobs;

use App\Models\Quote;
use App\Models\User;
use App\Notifications\NewQuote;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotifyNewQuote implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly Quote $quote
    )
    {
    }

    public function handle(): void
    {
        Notification::send(User::admin()->get(), new NewQuote($this->quote));
    }
}
