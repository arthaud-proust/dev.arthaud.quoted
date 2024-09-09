// @formatter:off
<x-mail::message>
# Nouvelle citation à valider

> {{ $quote->content }}
{{ $quote->author }}

Ajouté par {{ $quote->user->name }}

</x-mail::message>
