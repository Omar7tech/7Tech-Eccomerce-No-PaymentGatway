<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContentSettings extends Settings
{

    public bool $announcement_active;
    public ?string $announcement_content;
    public ?string $announcement_link;
    public bool $banner_active;
    public ?int $banner_mode;
    public bool $hero_enabled;
    public ?string $hero_image;
    public ?string $hero_title;
    public ?string $hero_description;
    public ?string $hero_link;
    public ?string $hero_link_text;
    public bool $category_home_enabled;
    public ?int $category_mode;
    public bool $category_display_image;
    public bool $category_display_description;
    public bool $category_show_product_count;
    public ?array $homepage_showcase_items = [];
    public ?string $theme_mode;
    public bool $allow_google_translate;

    public ?int $nav_category_menu_mode;
    public ?int $nav_mode;

    public bool $testimonial_active;
    public ?string $testimonial_title;
    public ?string $testimonial_description;
    public ?int $testimonial_design;

    public bool $new_products_enabled;
    public bool $featured_products_enabled;
    public bool $sale_products_enabled;
    public ?array $product_sections_order;
    public ?string $product_sections_position;

    public static function group(): string
    {
        return 'content';
    }
}
