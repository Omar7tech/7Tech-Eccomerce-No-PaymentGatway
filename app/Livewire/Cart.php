<?php

namespace App\Livewire;

use App\Services\CartService;
use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $totalItems = 0;
    public $cartSettings = [];
    public $errorMessage = null;

    protected $listeners = ['cart-updated' => 'refreshCart'];

    public function mount()
    {
        $this->refreshCart();
        $this->loadCartSettings();
    }

    public function loadCartSettings()
    {
        $cartService = app(CartService::class);
        $this->cartSettings = $cartService->getCartSettings();
    }

    public function refreshCart()
    {
        $cartService = app(CartService::class);
        $cart = $cartService->getCart();

        if (!empty($cart)) {
            $this->cartItems = [];
            $this->total = 0;
            $this->totalItems = 0;
            foreach ($cart as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $this->cartItems[] = [
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'sale_price' => $item['sale_price'],
                    ];
                    $price = ($product->is_on_sale && $product->sale_price) ? $product->sale_price : $product->price;
                    $this->total += $price * $item['quantity'];
                    $this->totalItems += $item['quantity'];
                }
            }

            // Get cart summary with delivery price
            $summary = $cartService->getCartSummary();
            $this->total = $summary['total']; // This now includes delivery price
        } else {
            $this->cartItems = [];
            $this->total = 0;
            $this->totalItems = 0;
        }

        $this->dispatch('cart-count-updated', count: $this->totalItems);
    }

    public function removeItem($productId)
    {
        $cartService = app(CartService::class);
        $cartService->removeFromCart($productId);
        $this->refreshCart();
        $this->dispatch('cart-updated', count: $this->totalItems);
    }

    public function updateQuantity($productId, $quantity)
    {
        $cartService = app(CartService::class);
        try {
            $cartService->updateQuantity($productId, $quantity);
            $this->errorMessage = null;
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
        $this->refreshCart();
        $this->dispatch('cart-updated', count: $this->totalItems);
    }

    public function clearCart()
    {
        $cartService = app(CartService::class);
        $cartService->clearCart();
        $this->refreshCart();
        $this->dispatch('cart-updated', count: $this->totalItems);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
