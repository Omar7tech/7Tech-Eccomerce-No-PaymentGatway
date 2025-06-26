<?php

namespace App\Filament\Resources\ProductStockResource\Pages;

use App\Filament\Resources\ProductStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Product;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
class ListProductStocks extends ListRecords
{
    protected static string $resource = ProductStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

     public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
             'Empty Stock' => Tab::make()->badge( Product::query()->where('stock',0)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('stock',0)),
            'active' => Tab::make()->badge( Product::query()->where('is_active', true)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', true)),
            'inactive' => Tab::make()->badge( Product::query()->where('is_active', false)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', false)),

        ];
    }
}
