<x-layout>
    <div class="container">
        <h1 class="text-4xl">Citations</h1>

        <ul class="mt-12 columns-2 gap-20 space-y-20">
            @foreach($quotes as $quote)
                <li class="break-inside-avoid relative py-4">
                    <a href="{{ route('quotes.show', $quote) }}"
                       class="after:absolute after:inset-y-0 after:-inset-x-6 after:rounded-3xl hover:after:bg-bunker-800 after:-z-10">
                        <blockquote class="text-5xl font-medium leading-tight">
                            {{ $quote->content }}
                        </blockquote>
                    </a>

                    <p class="mt-2 text-bunker-200">- {{ $quote->author }}</p>
                </li>
            @endforeach
        </ul>

        <div class="mt-20">
            {!! $quotes->withQueryString()->links() !!}
        </div>
    </div>
</x-layout>
