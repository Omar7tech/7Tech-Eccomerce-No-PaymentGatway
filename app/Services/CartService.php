<?php

namespace App\Services;

use App\Models\Product;
use App\Settings\CartSettings;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Get the cart from the session.
     */
    public function getCart(): array
    {
        return Session::get('cart', []);
    }

    /**
     * Add a product to the cart in the session.
     */
    public function addToCart(Product $product, int $quantity = 1): array
    {
        $cart = $this->getCart();
        $productId = $product->id;
        $productsSettings = app(\App\Settings\ProductsSettings::class);
        if ($productsSettings->work_with_stock) {
            $currentQty = isset($cart[$productId]) ? $cart[$productId]['quantity'] : 0;
            $newQty = $currentQty + $quantity;
            if ($product->stock !== null && $newQty > $product->stock) {
                throw new \Exception('Cannot add more than available stock.');
            }
        }
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'sale_price' => $product->sale_price,
                'name' => $product->name,
            ];
        }
        Session::put('cart', $cart);
        return $cart;
    }

    /**
     * Update product quantity in the cart.
     */
    public function updateQuantity(int $productId, int $quantity): array
    {
        $cart = $this->getCart();
        $product = \App\Models\Product::find($productId);
        $productsSettings = app(\App\Settings\ProductsSettings::class);
        if ($productsSettings->work_with_stock && $product) {
            if ($product->stock !== null && $quantity > $product->stock) {
                throw new \Exception('Cannot set quantity higher than available stock.');
            }
        }
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }
        return $cart;
    }

    /**
     * Remove a product from the cart.
     */
    public function removeFromCart(int $productId): array
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        Session::put('cart', $cart);
        return $cart;
    }

    /**
     * Clear the cart.
     */
    public function clearCart(): void
    {
        Session::forget('cart');
    }

    /**
     * Get cart summary (total items and subtotal).
     */
    public function getCartSummary(): array
    {
        $cart = $this->getCart();
        $total_items = 0;
        $subtotal = 0;
        foreach ($cart as $item) {
            $total_items += $item['quantity'];
            $price = $item['sale_price'] ?? $item['price'];
            $subtotal += $price * $item['quantity'];
        }

        $cartSettings = app(CartSettings::class);
        $deliveryPrice = $cartSettings->getDeliveryPrice();
        $total = $subtotal + $deliveryPrice;

        return [
            'total_items' => $total_items,
            'subtotal' => $subtotal,
            'delivery_price' => $deliveryPrice,
            'delivery_price_text' => $cartSettings->getDeliveryPriceText(),
            'total' => $total,
        ];
    }

    /**
     * Check if cash on delivery is available.
     */
    public function isCashOnDeliveryAvailable(): bool
    {
        $cartSettings = app(CartSettings::class);
        return $cartSettings->cashOnDeliveryActive;
    }

    /**
     * Get the WhatsApp number for cash on delivery orders.
     */
    public function getCashOnDeliveryWhatsappNumber(): ?string
    {
        $cartSettings = app(CartSettings::class);
        return $cartSettings->getCashOnDeliveryWhatsappNumber();
    }

    /**
     * Get cart settings for checkout.
     */
    public function getCartSettings(): array
    {
        $cartSettings = app(CartSettings::class);
        return [
            'cashOnDeliveryActive' => $cartSettings->cashOnDeliveryActive,
            'cashOnDeliveryWhatsappNumber' => $cartSettings->getCashOnDeliveryWhatsappNumber(),
            'takeDefaultWhatsappNumber' => $cartSettings->takeDefaultWhatsappNumber,
            'deliveryFree' => $cartSettings->deliveryFree,
            'deliveryPrice' => $cartSettings->getDeliveryPrice(),
            'deliveryPriceText' => $cartSettings->getDeliveryPriceText(),
        ];
    }
}
