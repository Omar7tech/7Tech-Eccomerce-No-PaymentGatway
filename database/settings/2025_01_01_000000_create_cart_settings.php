<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('cart.cashOnDeliveryActive', true);
        $this->migrator->add('cart.cashOnDeliveryWhatsappNumber', '+96171387946');
        $this->migrator->add('cart.takeDefaultWhatsappNumber', true);
        $this->migrator->add('cart.deliveryFree', true);
        $this->migrator->add('cart.deliveryPrice', 0.0);
    }
};
