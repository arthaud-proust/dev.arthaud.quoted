<x-layout>
    <div class="container max-w-lg">
        <h1 class="text-4xl">Ajouter une citation</h1>
        <p class="mt-2 text-bunker-200">
            La citation sera ajoutée une fois validée par un modérateur
        </p>
        <form class="flex flex-col gap-6 mt-12" action="{{route('quotes.store')}}" method="POST">
            @csrf

            <label class="flex flex-col gap-2">
                <span>Auteur</span>
                <input name="author" type="text" value="{{ old('author') }}" required>
                @error('author')
                <span class="text-red-100">{{$message}}</span>
                @enderror
            </label>

            <label class="flex flex-col gap-2">
                <span>Citation</span>
                <textarea name="content" type="text" required rows="2" class="resize-none">{{ old('content') }}</textarea>
                @error('content')
                <span class="text-red-100">{{$message}}</span>
                @enderror
            </label>

            <label class="flex flex-col gap-2">
                <div class="flex items-end px-0.5">
                    <span>Votre email</span>
                    <span class="text-base text-bunker-200 ml-auto">Ne sera pas affiché</span>
                </div>
                <input name="email" type="email" value="{{ old('email') }}" required>
                @error('email')
                <span class="text-red-100">{{$message}}</span>
                @enderror
            </label>

            <button type="submit">Ajouter la citation</button>
        </form>
    </div>
</x-layout>
