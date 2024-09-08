<ul class="md:columns-2 gap-20 space-y-10">
    @foreach($quotes as $quote)
        <li class="break-inside-avoid">
            <x-quote.card :quote="$quote" />
        </li>
    @endforeach
</ul>
