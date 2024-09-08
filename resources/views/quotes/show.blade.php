<x-layout>
    <div class="container">
        <blockquote class="text-7xl font-medium leading-tight">
            {{ $quote->content }}
        </blockquote>

        <p class="mt-2 text-bunker-200">- {{ $quote->author }}</p>

        <p class="mt-4">Ajouté par {{ $quote->user->name }}, {{ $quote->views }} vues</p>
    </div>
</x-layout>
