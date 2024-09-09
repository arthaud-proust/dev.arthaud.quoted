<x-layouts.app>
    <div class="container">
        <h1 class="text-4xl">
            @if($quotes->total() === 0)
                Aucune citation
            @elseif($quotes->total() === 1)
                Voir la citation
            @else
                Voir les {{ $quotes->total() }} citations
            @endif
            @if(request()->query('q'))
                avec la recherche "{{ request()->query('q') }}"
            @endif
        </h1>

        <div class="mt-32">
            <x-quote.grid :quotes="$quotes" />
        </div>

        <div class="mt-20">
            {!! $quotes->withQueryString()->links() !!}
        </div>
    </div>
</x-layouts.app>
