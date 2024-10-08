<x-layouts.app>
    <div class="container mt-8">
        <section>
            <h1 class="text-8xl md:text-9xl -ml-2">Quoted.</h1>
            <p class="mt-2 text-2xl md:text-4xl">Des citations philosophiques et poétiques.</p>
        </section>

        @if($lastQuotes->count())
        <section>
            <h2 class="text-2xl sm:text-3xl mt-40">Citation au hasard</h2>
            <div class="mt-4">
                <x-quote.card :quote="$randomQuote" />
            </div>
        </section>

        <section>
            <div class="text-2xl sm:text-3xl mt-40 flex items-center space-x-2">
                <h2>Derniers ajouts</h2>
                <span>-</span>
                <a href="{{ route('quotes.index') }}" class="text-2xl sm:text-3xl link">Tout voir</a>
            </div>
            <div class="mt-4">
                <x-quote.grid :quotes="$lastQuotes" />
            </div>
        </section>
        @endif
    </div>
</x-layouts.app>
