<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ProductsSettings extends Settings
{
    public int $card_mode = 1;
    public bool $work_with_stock = false;
    public bool $show_low_stock = false;
    public int $low_stock_threshold = 5;
    public bool $show_stock_number = false;

    public static function group(): string
    {
        return 'products';
    }
}
