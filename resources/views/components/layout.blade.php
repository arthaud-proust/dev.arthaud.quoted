<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Quoted' }}</title>

    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased bg-bunker-900 text-white text-lg">
<div class="min-h-screen">
    <header class="sticky z-50 top-0 bg-bunker-900">
        <div class="container  flex h-16 py-4 gap-4 justify-between ">
            <a href="/" class="link">Quoted.</a>

            <nav class="flex gap-4">
                <a href="{{ route('quotes.index') }}" class="link">Citations</a>
                <a href="{{ route('quotes.create') }}" class="link">Contribuer</a>
            </nav>
        </div>
    </header>

    <main class="py-20">
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


