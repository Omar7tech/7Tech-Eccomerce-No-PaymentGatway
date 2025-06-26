<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\CursorPaginator;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

  

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'active' => Tab::make()->badge( Product::query()->where('is_active', true)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', true)),
            'inactive' => Tab::make()->badge( Product::query()->where('is_active', false)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', false)),
            'new' => Tab::make()->badge( Product::query()->where('is_new', true)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_new', true)),
            'on sale' => Tab::make()->badge( Product::query()->where('is_on_sale', true)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_on_sale', true)),
            'featured' => Tab::make()->badge( Product::query()->where('is_featured', true)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_featured', true)),


        ];
    }


}
