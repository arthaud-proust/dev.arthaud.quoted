<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Quoted' }}</title>

    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <style>[x-cloak] {
            display: none !important;
        }</style>
</head>
<body class="font-sans antialiased bg-bunker-900 text-white text-lg" x-data="{isMenuOpen: false}">
<div class="min-h-screen">
    <header class="sticky z-50 top-0 bg-bunker-900">
        <div class="container  flex py-4 gap-4 justify-between ">
            <a href="{{ route('home') }}" class="link">Quoted.</a>

            <nav class="flex max-md:hidden gap-4">
                <form action="{{ route('quotes.index') }}" method="GET" class="flex bg-bunker-950 rounded-lg">
                    <label for="q" class="sr-only">Rechercher</label>
                    <input id="q" name="q" type="text" placeholder="Par auteur, mot..." value="{{ old('q') ?? request()->query('q') }}">
                    <button class="bg-transparent py-3" type="submit">
                        <span class="sr-only">Rechercher</span>
                        <x-heroicon-m-magnifying-glass class="h-full" />
                    </button>
                </form>
                <a href="{{ route('quotes.index') }}" class="link">Citations</a>
                <a href="{{ route('quotes.create') }}" class="link">Contribuer</a>
            </nav>

            <button class="z-50 md:hidden" @click="$refs.modal.showModal()">Menu</button>

            <dialog x-ref="modal"
                    class="md:hidden backdrop:bg-bunker-900 bg-bunker-900 m-0 container h-screen w-full flex-col max-w-full max-h-full text-white">
                <div class="h-full w-full flex flex-col">
                    <div class="flex py-4 justify-end">
                        <button class="z-50 md:hidden" @click="$refs.modal.close()">Fermer</button>
                    </div>

                    <div class="grow flex flex-col gap-12 py-8 justify-center px-4">
                        <form action="{{ route('quotes.index') }}" method="GET" class="flex bg-bunker-950 rounded-lg">
                            <label for="q" class="sr-only">Rechercher</label>
                            <input class="w-full" id="q" name="q" type="text" placeholder="Par auteur, mot..."
                                   value="{{ old('q') ?? request()->query('q') }}">
                            <button class="bg-transparent py-3" type="submit">
                                <span class="sr-only">Rechercher</span>
                                <x-heroicon-m-magnifying-glass class="h-full" />
                            </button>
                        </form>

                        <a href="{{ route('home') }}" class="link text-3xl">Accueil</a>
                        <a href="{{ route('quotes.index') }}" class="link text-3xl">Citations</a>
                        <a href="{{ route('quotes.create') }}" class="link text-3xl">Contribuer</a>
                    </div>
                </div>

            </dialog>
        </div>
    </header>

    <main class="py-12 md:py-20">
        {{ $slot }}
    </main>
</div>

<footer class=" py-20 bg-bunker-800">
    <div class="container">
        <p>Par <a href="https://arthaudproust.fr" class="link">Arthaud Proust</a></p>
        <p>Libre de droits</p>
    </div>
</footer>
</body>
</html>


