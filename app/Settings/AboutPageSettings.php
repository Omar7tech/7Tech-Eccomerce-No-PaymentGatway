<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutPageSettings extends Settings
{

    public bool $active;
    public ?string $title;
    public ?string $content;
    public static function group(): string
    {
        return 'AboutPage';
    }
}
