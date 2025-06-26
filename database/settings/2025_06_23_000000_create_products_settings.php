<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('products.card_mode', 1);
        $this->migrator->add('products.work_with_stock', false);
        $this->migrator->add('products.show_low_stock', false);
        $this->migrator->add('products.low_stock_threshold', 5);
        $this->migrator->add('products.show_stock_number', false);
    }
};
