<?php

namespace App\Livewire;

use App\Models\Product as ProductModel;
use App\Services\CartService;
use App\Services\WishlistService;
use Livewire\Component;

class Product extends Component
{
    public ProductModel $product;
    public $quantity = 1;
    public $selectedImage = 0;
    public $showToast = false;
    public $toastMessage = '';
    public $toastType = 'success';
    public $isInWishlist = false;

    public function mount(ProductModel $product)
    {
        $this->product = $product;
        $wishlistService = app(WishlistService::class);
        $this->isInWishlist = $wishlistService->isInWishlist($product);
    }

    public function getRelatedProducts()
    {
        $relatedProducts = ProductModel::where('id', '!=', $this->product->id)
            ->where(function ($query) {
                $query->where('category_id', $this->product->category_id)
                    ->orWhereHas('tags', function ($q) {
                        $q->whereIn('tags.id', $this->product->tags->pluck('id'));
                    });
            })
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return $relatedProducts;
    }

    public function selectImage($index)
    {
        $this->selectedImage = $index;
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
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

    public function toggleWishlist()
    {
        $wishlistService = app(WishlistService::class);
        $this->isInWishlist = $wishlistService->toggleWishlist($this->product);
        $this->showToast = true;
        $this->toastMessage = $this->isInWishlist ? 'Added to wishlist' : 'Removed from wishlist';
        $this->toastType = 'success';
    }

    public function render()
    {
        return view('livewire.product');
    }
}