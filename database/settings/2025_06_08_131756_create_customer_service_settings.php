<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('customerService.active', false);
        $this->migrator->add('customerService.widgetCode', '');
        $this->migrator->add('customerService.directChatLink', '');


    }
};
