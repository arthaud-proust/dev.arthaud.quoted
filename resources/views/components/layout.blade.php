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
    <nav class="container sticky top-0 flex py-4 gap-4 bg-bunker-900">
        <a href="{{ route('quotes.index') }}" class="link">Citations</a>
        <a href="{{ route('quotes.create') }}" class="link">Contribuer</a>
    </nav>

    <main class="py-20">
        {{ $slot }}
    </main>
</div>

<footer class=" py-20 bg-bunker-800">
    <div class="container">
        <p>Par <a href="https://arthaudproust.fr">Arthaud Proust</a></p>
        <p>Libre de droit</p>
    </div>
</footer>
</body>
</html>


