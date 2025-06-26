<?php
// Database Migration for adding image fields
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Eccomerce7');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.site_favicon', null);
    }
};