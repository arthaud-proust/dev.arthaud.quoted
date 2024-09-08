<x-layout>
    <div class="container flex flex-col">
        <blockquote class="mt-32 text-7xl font-medium leading-tight">
            {{ $quote->content }}
        </blockquote>

        <p class="mt-2 text-bunker-200">- {{ $quote->author }}</p>

        <div class="ml-auto mt-32">
            <p class="">Ajouté par {{ $quote->user->name }} le {{ $quote->created_at->translatedFormat('j F Y') }}</p>
            <p class="mt-2">{{ $quote->views }} vues</p>

            <h2 class="mt-4 text-2xl">Partager</h2>
            <p class="mt-2"><code
                    class="select-all text-base rounded-md p-2 bg-bunker-950">{{ route('quotes.show', ['quoteHash'=>$quote->hash]) }}</code></p>
        </div>
    </div>
</x-layout>
