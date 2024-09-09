<div class="relative py-4">
    <a href="{{ route('quotes.show', ['quoteHash'=>$quote->hash]) }}"
       class="after:absolute after:inset-y-0 after:-inset-x-6 after:rounded-3xl hover:after:bg-bunker-800 after:-z-10">
        <blockquote class="text-3xl md:text-5xl font-medium leading-tight">
            {{ $quote->content }}
        </blockquote>
    </a>

    <p class="mt-2 text-bunker-200">- {{ $quote->author }}</p>
</div>
