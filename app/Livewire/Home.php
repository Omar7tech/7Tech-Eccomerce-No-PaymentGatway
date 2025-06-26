<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;
use \App\Models\Category;
class Home extends Component
{
    public function render()
    {
        $banners = \App\Models\Banner::all()->where('is_active', true)->sortBy('order');
        $categories = Category::whereHas('products')->orderBy("sort", "asc")->limit(6)->get();
        $content = resolve(\App\Settings\ContentSettings::class);
        $settings = resolve(\App\Settings\GeneralSettings::class);

        $showcaseItemsConfig = $content->homepage_showcase_items ?? [];
        $showcaseItems = collect();

        foreach ($showcaseItemsConfig as $itemConfig) {
            if (empty($itemConfig['type']) || empty($itemConfig['id'])) {
                continue;
            }

            $modelClass = $itemConfig['type'] === 'category' ? Category::class : Tag::class;

            $item = $modelClass::with([
                'products' => function ($query) {
                    $query->where('is_active', true)->limit(10);
                }
            ])->find($itemConfig['id']);

            if ($item) {
                $showcaseItems->push($item);
            }
        }

        return view('livewire.home', compact('banners', 'categories', 'showcaseItems', 'settings', 'content'));
    }
}
