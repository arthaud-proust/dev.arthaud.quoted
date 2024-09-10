<x-layouts.default>
    <div class="container flex flex-col">
        <div class="h-screen my-auto flex flex-col justify-center">
            <blockquote class="text-4xl md:text-7xl font-medium leading-tight">
                {{ $quote->content }}
            </blockquote>

            <p class="mt-2 text-bunker-200">- {{ $quote->author }}@if($quote->source) dans {{ $quote->source }}@endif</p>
        </div>

        <div class="md:ml-auto mb-32">
            <p class="mt-2 flex space-x-2 items-center">
                <x-heroicon-s-eye class="size-5" />
                <span>{{ $quote->views }}</span>
            </p>

            <p class="mt-2 flex space-x-2 items-center">
                <x-heroicon-s-share class="size-5" />
                <span>{{ $quote->hash }}</span>
            </p>

            <p class="mt-2 flex space-x-2 items-center">
                <x-heroicon-s-user class="size-5" />
                <span>Par {{ $quote->user->name }}</span>
            </p>

            <p class="mt-2 flex space-x-2 items-center">
                <x-heroicon-s-calendar class="size-5" />
                <span>{{ $quote->created_at->translatedFormat('j M Y') }}</span>
            </p>
        </div>
    </div>
</x-layouts.default>
