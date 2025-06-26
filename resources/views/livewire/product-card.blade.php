@props([
    'product' => [],
    'isInWishlist' => false,
    'showLowStock' => false,
    'lowStockThreshold' => 0,
    'showStockNumber' => false,
])
@php
    $firstImage = $product->firstSortedImage;
    $discountPercent =
        $product->sale_price && $product->is_on_sale
            ? round((($product->price - $product->sale_price) / $product->price) * 100)
            : 0;
@endphp

<div
    class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 h-full flex flex-col rounded-box overflow-hidden group border border-base-200 hover:border-primary/30 relative">

    {{-- Loading overlay --}}
    <div wire:loading wire:target="addToCart, toggleWishlist"
        class="absolute inset-0 bg-base-100/50 backdrop-blur-sm flex items-center justify-center z-20 rounded-box">
        <span class="loading loading-spinner loading-md sm:loading-lg text-primary"></span>
    </div>

    {{-- Share Button - Positioned over the image --}}
    <div class="absolute top-2 right-2 z-10" x-data="{
        async shareProduct() {
            const productData = {
                title: '{{ addslashes($product->name) }}',
                text: 'Check out this awesome product!',
                url: '{{ route('product.show', $product->slug) }}'
            };

            // Check if Web Share API is supported and available
            if (navigator.share && navigator.canShare && navigator.canShare(productData)) {
                try {
                    await navigator.share(productData);
                    return;
                } catch (error) {
                    // User cancelled or error occurred, fall back to alert
                    if (error.name !== 'AbortError') {
                        alert('Unable to share. Product link: ' + productData.url);
                    }
                }
            } else {
                // Fallback to alert with the URL
                alert('Share this product: ' + productData.url);
            }
        }
    }">
        <button @click.prevent.stop='shareProduct'
            class='btn z-10 btn-circle btn-ghost btn-xs sm:btn-sm tooltip tooltip-left bg-base-100/80 backdrop-blur-sm hover:bg-base-100 border border-base-200/50'
            data-tip='Share' aria-label='Share product'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5'
                stroke='currentColor' class='size-3.5 sm:size-4'>
                <path stroke-linecap='round' stroke-linejoin='round'
                    d='M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z' />
            </svg>
        </button>
    </div>

    {{-- Main clickable area for the product details --}}
    <a wire:navigate href="{{ route('product.show', $product->slug) }}" class="contents">
        <figure class="relative aspect-square overflow-hidden bg-base-200 flex-shrink-0">
            @if ($firstImage && $firstImage->image_path)
                <img src="{{ Storage::url($firstImage->image_path) }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    loading="lazy" alt="{{ $product->name }}" />
            @else
                <img src="{{ asset('icons/noimage.png') }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    loading="lazy" alt="{{ $product->name }}" />
            @endif

            <div class="absolute top-2 left-2 flex flex-col gap-1 z-10">
                @if ($product->sale_price && $product->is_on_sale)
                    <div
                        class="badge badge-error badge-sm text-error-content font-semibold shadow-md transform -rotate-3 origin-top-left px-2 py-1">
                        @if ($discountPercent > 0)
                            -{{ $discountPercent }}%
                        @else
                            SALE!
                        @endif
                    </div>
                @endif
                @if ($product->is_new)
                    <div
                        class="badge badge-success badge-sm text-success-content font-semibold shadow-md transform rotate-2 origin-top-left px-2 py-1">
                        NEW
                    </div>
                @endif
                @if ($product->is_featured && !($product->sale_price && $product->is_on_sale) && !$product->is_new)
                    <div
                        class="badge badge-warning badge-sm text-warning-content font-semibold shadow-md transform -rotate-1 origin-top-left px-2 py-1">
                        FEATURED
                    </div>
                @endif
                @if ($showLowStock && $product->stock <= $lowStockThreshold)
                    <div
                        class="badge badge-warning badge-sm text-warning-content font-semibold shadow-md transform rotate-1 origin-top-left px-2 py-1">
                        Low Stock{{ $showStockNumber ? ': ' . $product->stock : '' }}
                    </div>
                @endif
                @if ($showStockNumber && (!$showLowStock || $product->stock > $lowStockThreshold))
                    <div
                        class="badge badge-info badge-sm text-info-content font-semibold shadow-md transform rotate-1 origin-top-left px-2 py-1">
                        In Stock: {{ $product->stock }}
                    </div>
                @endif
            </div>
        </figure>

        <div class="p-2 sm:p-3 flex flex-col flex-grow">
            @if ($product->category)
                <div class="flex items-center gap-1 mb-2">
                    <svg class="w-3 h-3 text-base-content/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    <span class="text-xs text-base-content/70 font-medium uppercase tracking-wide">
                        {{ $product->category->name }}
                    </span>
                </div>
            @endif

            <h3 class="text-sm font-semibold text-base-content line-clamp-2 leading-tight mb-1">
                {{ $product->name }}
            </h3>
            <p class="text-xs text-base-content/60 line-clamp-2 leading-tight mb-2">
                {{ $product->description }}
            </p>

            @if ($product->tags && $product->tags->count() > 0)
                <div class="flex flex-wrap gap-1 mb-2">
                    @foreach ($product->tags->take(3) as $tag)
                        <span class="badge badge-outline badge-xs text-base-content/70 border-base-content/20">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                    @if ($product->tags->count() > 3)
                        <span class="badge badge-outline badge-xs text-base-content/50 border-base-content/20">
                            +{{ $product->tags->count() - 3 }}
                        </span>
                    @endif
                </div>
            @endif

            <div class="flex items-baseline gap-1 mt-auto">
                @if ($product->sale_price && $product->is_on_sale)
                    <span class="text-sm font-bold text-primary">${{ number_format($product->sale_price, 2) }}</span>
                    <span
                        class="text-xs text-base-content/50 line-through">${{ number_format($product->price, 2) }}</span>
                @else
                    <span class="text-sm font-bold text-primary">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>
        </div>
    </a>

    {{-- Action buttons at the bottom --}}
    <div class="p-2 sm:p-3 pt-0 flex justify-between gap-1">
        <button wire:click="addToCart" class="btn btn-primary btn-xs sm:btn-sm flex-1">
            Add
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-3.5 sm:size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
        </button>
        <button wire:click="toggleWishlist" class="btn btn-neutral text-red-400 btn-xs sm:btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $isInWishlist ? 'currentColor' : 'none' }}"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5 sm:size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>
    </div>
</div>
