<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = ['user_id'];

    /**
     * Get the user that owns the cart.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products in the cart.
     */
    public function products(): HasMany
    {
        return $this->hasMany(CartProduct::class);
    }

    /**
     * Get the total number of items in the cart.
     */
    public function getTotalItemsAttribute(): int
    {
        return $this->products->sum('quantity');
    }

    /**
     * Get the subtotal of the cart.
     */
    public function getSubtotalAttribute(): float
    {
        return $this->products->sum(function ($item) {
            return ($item->sale_price ?? $item->price) * $item->quantity;
        });
    }

    /**
     * Add a product to the cart.
     */
    public function addProduct(Product $product, int $quantity = 1): CartProduct
    {
        $existingProduct = $this->products()->where('product_id', $product->id)->first();

        if ($existingProduct) {
            // If product exists, increment the quantity
            $existingProduct->increment('quantity', $quantity);
            return $existingProduct->fresh();
        }

        // If product doesn't exist, create new cart item
        return $this->products()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
            'sale_price' => $product->sale_price,
        ]);
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function updateQuantity(int $productId, int $quantity): bool
    {
        return $this->products()
            ->where('product_id', $productId)
            ->update(['quantity' => $quantity]);
    }

    /**
     * Remove a product from the cart.
     */
    public function removeProduct(int $productId): bool
    {
        return $this->products()
            ->where('product_id', $productId)
            ->delete();
    }

    /**
     * Clear all products from the cart.
     */
    public function clear(): bool
    {
        return $this->products()->delete();
    }
}