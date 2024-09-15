<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Quoted' }}</title>

    @vite('resources/css/app.css')
</head>
<body class="overflow-x-hidden font-sans antialiased bg-bunker-900 text-white text-lg" x-data="{isMenuOpen: false}">
<header class="fixed w-full z-50 top-0 bg-bunker-900">
    <div class="container h-16 flex gap-4 justify-between items-center">
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

        <button class="z-50 md:hidden" id="menuOpener">Menu</button>

        <dialog id="menu"
                class="md:hidden backdrop:bg-bunker-900 bg-bunker-900 m-0 container h-screen w-full flex-col max-w-full max-h-full text-white">
            <div class="h-full w-full flex flex-col">
                <div class="flex h-16 items-center justify-end">
                    <button class="z-50 md:hidden" id="menuCloser">Fermer</button>
                </div>

                <div class="grow flex flex-col space-y-8 py-8 justify-center px-4">
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

        <script>
            const menu = document.getElementById("menu");
            document.getElementById("menuOpener").addEventListener("click", function() {
                menu.showModal();
            });
            document.getElementById("menuCloser").addEventListener("click", function() {
                menu.close();
            });
        </script>
    </div>
</header>

<main class="min-h-screen w-full overflow-x-hidden">
    {{ $slot }}

    <div class="fixed bottom-4 right-4 z-50">
        @if(session('success'))
            <div class="rounded-md px-6 py-4 text-emerald-600 bg-emerald-100 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
</main>

<footer class=" py-20 bg-bunker-800">
    <div class="container">
        <p>Par <a href="https://arthaudproust.fr" class="link">Arthaud Proust</a></p>
        <p>Libre de droits</p>
    </div>
</footer>
</body>
</html>


