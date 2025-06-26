<?php

namespace App\Livewire;

use App\Services\CartService;
use App\Models\Product;
use Livewire\Component;

class CartDrawer extends Component
{
    public $isOpen = false;
    public $cartItems = [];
    public $totalItems = 0;
    public $subtotal = 0;
    public $deliveryPrice = 0;
    public $deliveryPriceText = 'Free';
    public $total = 0;

    protected $listeners = [
        'cartUpdated' => 'refreshCart',
        'openCart' => 'open',
        'closeCart' => 'close',
    ];

    public function mount()
    {
        $this->refreshCart();
    }

    public function refreshCart()
    {
        $cartService = app(CartService::class);
        $cart = $cartService->getCart();

        if (!empty($cart)) {
            $this->cartItems = [];
            $this->totalItems = 0;
            $this->subtotal = 0;
            foreach ($cart as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $this->cartItems[] = [
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'sale_price' => $item['sale_price'],
                    ];
                    $price = $item['sale_price'] ?? $item['price'];
                    $this->subtotal += $price * $item['quantity'];
                    $this->totalItems += $item['quantity'];
                }
            }

            // Get cart summary with delivery price
            $summary = $cartService->getCartSummary();
            $this->deliveryPrice = $summary['delivery_price'];
            $this->deliveryPriceText = $summary['delivery_price_text'];
            $this->total = $summary['total'];
        } else {
            $this->cartItems = [];
            $this->totalItems = 0;
            $this->subtotal = 0;
            $this->deliveryPrice = 0;
            $this->deliveryPriceText = 'Free';
            $this->total = 0;
        }
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function updateQuantity($productId, $quantity)
    {
        $cartService = app(CartService::class);
        $cartService->updateQuantity($productId, $quantity);
        $this->refreshCart();
        $this->dispatch('cartUpdated');
    }

    public function removeItem($productId)
    {
        $cartService = app(CartService::class);
        $cartService->removeFromCart($productId);
        $this->refreshCart();
        $this->dispatch('cartUpdated');
    }

    public function clearCart()
    {
        $cartService = app(CartService::class);
        $cartService->clearCart();
        $this->refreshCart();
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.cart-drawer');
    }
}
