<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use App\Models\Quote;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListQuotes extends ListRecords
{
    protected static string $resource = QuoteResource::class;

    public function getTabs(): array
    {
        return [
            'notValidated' => Tab::make('Non validées')
                ->modifyQueryUsing(fn(Builder $query) => $query->notValidated())
                ->badge(Quote::notValidated()->count())
                ->badgeColor(Quote::notValidated()->count() ? 'warning' : 'success'),
            'validated' => Tab::make('Validées')
                ->modifyQueryUsing(fn(Builder $query) => $query->validated()),
            'all' => Tab::make('Toutes'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
