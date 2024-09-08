<x-layout>
    <div class="container">
        <h1 class="text-4xl">Voir les {{ $quotes->total() }} citations</h1>

        <div class="mt-32">
            <x-quote.grid :quotes="$quotes" />
        </div>

        <div class="mt-20">
            {!! $quotes->withQueryString()->links() !!}
        </div>
    </div>
</x-layout>
