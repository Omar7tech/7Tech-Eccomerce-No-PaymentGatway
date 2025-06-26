<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class WishlistService
{
    /**
     * Toggle a product in the wishlist (add/remove) in the session.
     */
    public function toggleWishlist(Product $product): bool
    {
        $wishlist = Session::get('wishlist', []);
        $productId = $product->id;
        if (in_array($productId, $wishlist)) {
            $wishlist = array_diff($wishlist, [$productId]);
            Session::put('wishlist', $wishlist);
            return false;
        } else {
            $wishlist[] = $productId;
            Session::put('wishlist', $wishlist);
            return true;
        }
    }

    /**
     * Check if a product is in the wishlist (session).
     */
    public function isInWishlist(Product $product): bool
    {
        $wishlist = Session::get('wishlist', []);
        return in_array($product->id, $wishlist);
    }

    /**
     * Get all wishlist products from the session.
     */
    public function getWishlistProducts()
    {
        $wishlist = Session::get('wishlist', []);
        return Product::whereIn('id', $wishlist)->get();
    }
}
