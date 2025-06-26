# Cart Settings Documentation

## Overview

The Cart Settings system allows you to configure cash on delivery (COD) options and delivery pricing for your e-commerce application. It provides flexible WhatsApp number management for COD orders and configurable delivery costs.

## Features

### 1. Cash on Delivery Configuration
- **Enable/Disable COD**: Toggle cash on delivery functionality
- **Dynamic WhatsApp Number**: Use either default contact settings or custom COD WhatsApp number
- **Automatic Number Selection**: Smart fallback to contact settings when enabled

### 2. Delivery Price Configuration
- **Free Delivery Option**: Toggle between free delivery and paid delivery
- **Custom Delivery Price**: Set specific delivery cost when free delivery is disabled
- **Dynamic Display**: Automatic calculation and display in cart

### 3. Settings Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `cashOnDeliveryActive` | boolean | `true` | Enable/disable cash on delivery |
| `cashOnDeliveryWhatsappNumber` | string | `+96171387946` | Custom WhatsApp number for COD orders |
| `takeDefaultWhatsappNumber` | boolean | `true` | Use WhatsApp number from contact settings |
| `deliveryFree` | boolean | `true` | Enable free delivery for all orders |
| `deliveryPrice` | float | `0.0` | Delivery price when free delivery is disabled |

## Usage

### In Controllers/Services

```php
use App\Services\CartService;
use App\Settings\CartSettings;

// Get cart service
$cartService = app(CartService::class);

// Check if COD is available
if ($cartService->isCashOnDeliveryAvailable()) {
    // COD is enabled
}

// Get WhatsApp number for COD
$whatsappNumber = $cartService->getCashOnDeliveryWhatsappNumber();

// Get cart summary with delivery price
$summary = $cartService->getCartSummary();
echo "Subtotal: $" . number_format($summary['subtotal'], 2);
echo "Delivery: " . $summary['delivery_price_text'];
echo "Total: $" . number_format($summary['total'], 2);

// Get all cart settings
$settings = $cartService->getCartSettings();
```

### In Livewire Components

```php
use App\Services\CartService;

class YourComponent extends Component
{
    public $cartSettings = [];

    public function mount()
    {
        $cartService = app(CartService::class);
        $this->cartSettings = $cartService->getCartSettings();
    }
}
```

### In Blade Views

```blade
<!-- Display delivery price -->
<div class="flex justify-between">
    <span>Delivery:</span>
    <span class="{{ $cartSettings['deliveryFree'] ? 'text-success' : 'text-base-content' }}">
        {{ $cartSettings['deliveryPriceText'] }}
    </span>
</div>

<!-- Show COD button if available -->
@if($cartSettings['cashOnDeliveryActive'] && $cartSettings['cashOnDeliveryWhatsappNumber'])
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cartSettings['cashOnDeliveryWhatsappNumber']) }}?text=...">
        Cash on Delivery
    </a>
@endif
```

## Admin Panel

Access cart settings through the Filament admin panel:

1. Navigate to **Settings** → **Cart Settings**
2. Configure the following options:

### Cash on Delivery Settings
- **Enable Cash on Delivery**: Toggle COD functionality
- **Use Default WhatsApp Number**: Use contact settings WhatsApp number
- **Custom WhatsApp Number for COD**: Set custom number (only visible when default is disabled)

### Delivery Settings
- **Free Delivery**: Toggle free delivery for all orders
- **Delivery Price**: Set delivery cost (only visible when free delivery is disabled)

## WhatsApp Number Logic

The system uses the following logic to determine the WhatsApp number for COD orders:

1. If `takeDefaultWhatsappNumber` is `true`:
   - Uses the WhatsApp number from `ContactSettings`
2. If `takeDefaultWhatsappNumber` is `false`:
   - Uses the custom `cashOnDeliveryWhatsappNumber`

## Delivery Price Logic

The system uses the following logic to calculate delivery costs:

1. If `deliveryFree` is `true`:
   - Delivery price is $0.00
   - Display shows "Free"
2. If `deliveryFree` is `false`:
   - Uses the `deliveryPrice` value
   - Display shows the formatted price (e.g., "$5.99")

## Integration with Existing Cart

The cart settings are automatically integrated with the existing cart functionality:

- **Cart View**: Shows/hides COD button based on settings
- **Delivery Display**: Shows dynamic delivery price instead of hardcoded "Free"
- **Total Calculation**: Includes delivery price in cart totals
- **WhatsApp Integration**: Uses dynamic WhatsApp number for COD orders
- **Order Processing**: Respects COD availability and delivery costs during checkout

## Migration

The cart settings are automatically created when you run:

```bash
php artisan migrate
```

This creates the necessary database entries with default values.

## Default Values

- `cashOnDeliveryActive`: `true`
- `cashOnDeliveryWhatsappNumber`: `+96171387946`
- `takeDefaultWhatsappNumber`: `true`
- `deliveryFree`: `true`
- `deliveryPrice`: `0.0`

## Files Created/Updated

1. **Settings Class**: `app/Settings/CartSettings.php`
2. **Migration**: `database/settings/2025_01_01_000000_create_cart_settings.php`
3. **Admin Page**: `app/Filament/Pages/ManageCartSettings.php`
4. **Service Integration**: Enhanced `app/Services/CartService.php`
5. **View Integration**: Updated `resources/views/livewire/cart.blade.php`
6. **Component Integration**: Updated `app/Livewire/Cart.php`

## Helper Methods

### CartSettings Class
- `getCashOnDeliveryWhatsappNumber()`: Returns appropriate WhatsApp number
- `getDeliveryPrice()`: Returns delivery price (0 if free)
- `getDeliveryPriceText()`: Returns formatted delivery price text

### CartService Class
- `isCashOnDeliveryAvailable()`: Check if COD is enabled
- `getCashOnDeliveryWhatsappNumber()`: Get COD WhatsApp number
- `getCartSettings()`: Get all cart settings
- `getCartSummary()`: Get cart summary with delivery price included
