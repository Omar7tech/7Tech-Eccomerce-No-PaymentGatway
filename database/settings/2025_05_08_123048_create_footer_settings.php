<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('footer.footer_enabled', true);
        $this->migrator->add('footer.footer_style', 1);
        $this->migrator->add('footer.footer_text', 'This is the footer text');
        $this->migrator->add('footer.footer_links', []);
        $this->migrator->add('footer.footer_socials', []);
        $this->migrator->add('footer.footer_phones', []);
        $this->migrator->add('footer.footer_emails', []);
        $this->migrator->add('footer.footer_locations', []);
    }
};