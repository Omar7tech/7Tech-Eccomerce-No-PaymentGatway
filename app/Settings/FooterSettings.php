<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FooterSettings extends Settings
{
    public int $footer_style;
    public bool $footer_enabled;
    public ?string $footer_text;
    public ?array $footer_links;
    public ?array $footer_socials;
    public ?array $footer_phones;
    public ?array $footer_emails;
    public ?array $footer_locations;

    public static function group(): string
    {
        return 'footer';
    }
}