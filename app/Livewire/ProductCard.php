<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use App\Services\CartService;
use App\Services\WishlistService;
use App\Settings\ProductsSettings;

#[Lazy(isolate: false)]
class ProductCard extends Component
{
    public Product $product;
    public bool $isInWishlist = false;
    public $quantity = 1;
    public $showToast = false;
    public $toastMessage = '';
    public $toastType = 'success';

    public function mount(Product $product)
    {
        $this->product = $product;
        $wishlistService = app(WishlistService::class);
        $this->isInWishlist = $wishlistService->isInWishlist($product);
    }

    public function toggleWishlist()
    {
        $wishlistService = app(WishlistService::class);
        $this->isInWishlist = $wishlistService->toggleWishlist($this->product);
        $this->showToast = true;
        $this->toastMessage = $this->isInWishlist ? 'Added to wishlist' : 'Removed from wishlist';
        $this->toastType = 'success';
    }

    public function addToCart()
    {
        try {
            $cartService = app(CartService::class);
            $cartService->addToCart($this->product, $this->quantity);
            $summary = $cartService->getCartSummary();
            $this->showToast = true;
            $this->toastMessage = 'Added to cart';
            $this->toastType = 'success';
            $this->dispatch('cart-updated', count: $summary['total_items']);
        } catch (\Exception $e) {
            $this->showToast = true;
            $this->toastMessage = 'Failed to add to cart';
            $this->toastType = 'error';
        }
    }

    public function placeholder(array $params = [])
    {
        return view('components.placeholder.product-card', $params);
    }

    public function render()
    {
        $p_settings = resolve(\App\Settings\ProductsSettings::class);
        $viewData = [
            'showLowStock' => $p_settings->show_low_stock,
            'lowStockThreshold' => $p_settings->low_stock_threshold,
            'showStockNumber' => $p_settings->show_stock_number,
        ];
        if ($p_settings->card_mode == 1) {
            return view('livewire.product-card', $viewData);
        }
        return view('livewire.product-card2', $viewData);
    }
}
