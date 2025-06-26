<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CustomerServiceSettings extends Settings
{
    public bool $active;
    public ?string $widgetCode;
    public ?string $directChatLink;

    public static function group(): string
    {
        return 'CustomerService';
    }
}
