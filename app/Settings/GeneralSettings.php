<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $site_name;
    public bool $site_active;
    public ?string $site_logo;
    public ?string $site_favicon;

    public static function group(): string
    {
        return 'general';
    }
}
