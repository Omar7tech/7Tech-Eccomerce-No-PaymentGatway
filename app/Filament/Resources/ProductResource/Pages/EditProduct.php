<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;




    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function (Product $product) {
                $images = ProductImage::where('product_id', $product->id)->get();

                if ($images) {
                    foreach ($images as $image) {
                        if ($image->image_path) {
                            Storage::disk('public')->delete($image->image_path);
                        }
                    }
                }
            }),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function (Product $product) {
                $images = ProductImage::where('product_id', $product->id)->get();

                if ($images) {
                    foreach ($images as $image) {
                        if ($image->image_path) {
                            Storage::disk('public')->delete($image->image_path);
                        }
                    }
                }
            }),
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
}
