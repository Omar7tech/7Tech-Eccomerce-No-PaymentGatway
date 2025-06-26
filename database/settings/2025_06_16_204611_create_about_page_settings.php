<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('AboutPage.active', false);
        $this->migrator->add('AboutPage.title', 'About Us');
        $this->migrator->add('AboutPage.content', 'Welcome to our store! We are dedicated to providing the best products and services to our customers.');

    }
};
