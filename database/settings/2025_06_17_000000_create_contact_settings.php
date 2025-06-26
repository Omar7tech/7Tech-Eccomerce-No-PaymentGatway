<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('contact.whatsapp_number', '+96171387946');
        $this->migrator->add('contact.phone_number', '+96171387946');
        $this->migrator->add('contact.email', 'omar.7tech@gmail.com');
        $this->migrator->add('contact.contact_enabled', true);
        $this->migrator->add('contact.whatsapp_enabled', true);
        $this->migrator->add('contact.phone_number_enabled', true);
        $this->migrator->add('contact.email_enabled', true);
        $this->migrator->add('contact.contact_design', 1);
    }
};