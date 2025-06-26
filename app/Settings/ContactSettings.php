<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactSettings extends Settings
{
    public ?string $whatsapp_number;
    public ?string $phone_number;
    public ?string $email;
    public bool $contact_enabled;
    public bool $whatsapp_enabled;
    public bool $phone_number_enabled;
    public bool $email_enabled;
    public int $contact_design = 1;

    public static function group(): string
    {
        return 'contact';
    }
}
