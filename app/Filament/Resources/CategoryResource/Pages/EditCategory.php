<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function (Category $category) {
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $category->products()->each(function (Product $product) {
                    $images = $product->images()->get();
                    if ($images) {
                        foreach ($images as $image) {
                            if ($image->image_path) {
                                Storage::disk('public')->delete($image->image_path);
                            }
                        }
                    }

                    $product->delete();
                });
            }),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (Category $record) {
                    if ($record->image) {
                        Storage::disk('public')->delete($record->image);
                    }
                    $record->products()->each(function (Product $product) {
                        $images = $product->images()->get();
                        if ($images) {
                            foreach ($images as $image) {
                                if ($image->image_path) {
                                    Storage::disk('public')->delete($image->image_path);
                                }
                            }
                        }
                        $product->delete();
                    });
                })
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
}
