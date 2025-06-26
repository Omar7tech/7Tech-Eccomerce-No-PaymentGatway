<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CartSettings extends Settings
{
    public bool $cashOnDeliveryActive;
    public ?string $cashOnDeliveryWhatsappNumber;
    public bool $takeDefaultWhatsappNumber;
    public bool $deliveryFree;
    public ?float $deliveryPrice;

    public static function group(): string
    {
        return 'cart';
    }

    /**
     * Get the WhatsApp number for cash on delivery orders
     * Returns the default contact WhatsApp number if takeDefaultWhatsappNumber is true,
     * otherwise returns the custom cash on delivery WhatsApp number
     */
    public function getCashOnDeliveryWhatsappNumber(): ?string
    {
        if ($this->takeDefaultWhatsappNumber) {
            $contactSettings = app(ContactSettings::class);
            return $contactSettings->whatsapp_number;
        }

        return $this->cashOnDeliveryWhatsappNumber;
    }

    /**
     * Get the delivery price for the cart
     * Returns 0 if delivery is free, otherwise returns the set delivery price
     */
    public function getDeliveryPrice(): float
    {
        return $this->deliveryFree ? 0 : ($this->deliveryPrice ?? 0);
    }

    /**
     * Get the delivery price display text
     */
    public function getDeliveryPriceText(): string
    {
        return $this->deliveryFree ? 'Free' : '$' . number_format($this->deliveryPrice ?? 0, 2);
    }
}
