<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchQuoteRequest;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use App\Models\User;
use App\Notifications\NewQuote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use function abort;
use function redirect;
use function view;

class QuoteController extends Controller
{
    public function index(SearchQuoteRequest $request)
    {
        $validated = $request->validated();
        $quotes = Quote::validated()
            ->when(isset($validated['q']), static fn($query) => $query
                ->where('content', 'LIKE', "%{$validated['q']}%")
                ->orWhere('author', 'LIKE', "%{$validated['q']}%")
            );

        return view('quotes.index', [
            'quotes' => $quotes->paginate(10),
        ]);
    }

    public function create()
    {
        return view('quotes.create');
    }

    public function store(StoreQuoteRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::firstOrCreate(
            [
                'email' => $validated['email'],
            ],
            [
                'name' => User::extractNameFromEmail($validated['email']),
                'password' => Str::random(32),
            ]
        );

        $quote = Quote::create([
            'author' => $validated['author'],
            'content' => $validated['content'],
            'source' => $validated['source'] ?? null,
            'user_id' => $user->id,
        ]);

        Notification::send(User::admin()->get(), new NewQuote($quote));

        return redirect()->route('quotes.index');
    }

    public function show(Quote $quote)
    {
        if (!$quote->validated) {
            abort(404);
        }

        $quote->update([
            'views' => $quote->views + 1,
        ]);

        return view('quotes.show', [
            'quote' => new QuoteResource($quote),
        ]);
    }
}
