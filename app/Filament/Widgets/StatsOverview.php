<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Settings\GeneralSettings;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Product & Inventory Stats
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $outOfStockProducts = Product::where('stock', '=', 0)->count();
        $lowStockProducts = Product::where('stock', '>', 0)->where('stock', '<=', 5)->count(); // Assuming low stock is 5 or less
        $featuredProducts = Product::where('is_featured', true)->count();
        $productsWithoutImages = Product::doesntHave('images')->count();

        // Content Stats
        $totalCategories = Category::count();
        $activeBanners = Banner::where('is_active', true)->count();
        $totalTestimonials = Testimonial::count();

        $stats = [
            // Product Stats
            Stat::make('Total Products', $totalProducts)
                ->description('All products in the catalog')
                ->descriptionIcon('heroicon-o-cube')
                ->color('primary')
                ->url(route('filament.admin.resources.products.index')),

            Stat::make('Featured Products', $featuredProducts)
                ->description('Products shown on the homepage')
                ->descriptionIcon('heroicon-o-star')
                ->color('success')
                ->url(route('filament.admin.resources.products.index', ['tab' => 'is_featured'])),

            Stat::make('Total Categories', $totalCategories)
                ->description('Number of product categories')
                ->descriptionIcon('heroicon-o-rectangle-group')
                ->color('primary')
                ->url(route('filament.admin.resources.categories.index')),

            // Inventory Health
            Stat::make('Out of Stock', $outOfStockProducts)
                ->description('Products with zero inventory')
                ->descriptionIcon('heroicon-o-exclamation-circle')
                ->color($outOfStockProducts > 0 ? 'danger' : 'success')
                ->url(route('filament.admin.resources.products.index', ['tab' => 'out_of_stock'])),

            Stat::make('Low Stock', $lowStockProducts)
                ->description('Products with 5 or less stock')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($lowStockProducts > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.products.index', ['tab' => 'low_stock'])),

            Stat::make('Products without Images', $productsWithoutImages)
                ->description('Products needing photos')
                ->descriptionIcon('heroicon-o-photo')
                ->color($productsWithoutImages > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.products.index', ['tab' => 'no_images'])),


            // Content Health
            Stat::make('Active Banners', $activeBanners)
                ->description('Promotional banners currently live')
                ->descriptionIcon('heroicon-o-gift')
                ->color('success')
                ->url(route('filament.admin.resources.banners.index')),

            Stat::make('Total Testimonials', $totalTestimonials)
                ->description('Customer reviews received')
                ->descriptionIcon('heroicon-o-chat-bubble-left-right')
                ->color('info')
                ->url(route('filament.admin.resources.testimonials.index')),

        ];

        return $stats;
    }
}
