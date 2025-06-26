<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('content.announcement_active', false);
        $this->migrator->add('content.announcement_content', "Welcome to our website!");
        $this->migrator->add('content.announcement_link', '');

        $this->migrator->add('content.banner_active', true);
        $this->migrator->add('content.banner_mode', 1);
        $this->migrator->add('content.theme_mode', 'dark');
        $this->migrator->add('content.hero_enabled', true);
        $this->migrator->add('content.hero_image', 'hero.jpg');
        $this->migrator->add('content.hero_title', 'Welcome to Our Store');
        $this->migrator->add('content.hero_description', 'Discover the best products at unbeatable prices.');
        $this->migrator->add('content.hero_link', '');
        $this->migrator->add('content.hero_link_text', '🛒 Start Shopping');
        $this->migrator->add('content.category_home_enabled', true);
        $this->migrator->add('content.category_mode', 1);
        $this->migrator->add('content.category_display_image', true);
        $this->migrator->add('content.category_display_description', true);
        $this->migrator->add('content.category_show_product_count', true);
        $this->migrator->add('content.homepage_showcase_items', []);
        $this->migrator->add('content.allow_google_translate', false);

        $this->migrator->add('content.nav_category_menu_mode', 1);
        $this->migrator->add('content.nav_mode', 1);

        $this->migrator->add('content.testimonial_active', true);
        $this->migrator->add('content.testimonial_title', 'What Our Customers Say');
        $this->migrator->add('content.testimonial_description', "Don't just take our word for it - hear from our amazing customers");
        $this->migrator->add('content.testimonial_design', 1);

        $this->migrator->add('content.new_products_enabled', true);
        $this->migrator->add('content.featured_products_enabled', true);
        $this->migrator->add('content.sale_products_enabled', true);
        $this->migrator->add('content.product_sections_position', 'after_showcase');
        $this->migrator->add('content.product_sections_order', [['section' => 'new'], ['section' => 'featured'], ['section' => 'sale']]);
    }
};
