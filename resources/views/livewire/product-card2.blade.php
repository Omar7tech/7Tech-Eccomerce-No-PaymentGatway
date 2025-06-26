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
    class="group relative bg-base-100 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 h-full flex flex-col overflow-hidden border border-base-content/5 hover:border-primary/20 hover:-translate-y-0.5">

    {{-- Share Button - Compact --}}
    <div class="absolute top-2 right-2 z-20" x-data="{
        async shareProduct() {
            const productData = {
                title: '{{ addslashes($product->name) }}',
                text: 'Check out this awesome product!',
                url: '{{ route('product.show', $product->slug) }}'
            };

            if (navigator.share && navigator.canShare && navigator.canShare(productData)) {
                try {
                    await navigator.share(productData);
                    return;
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        alert('Unable to share. Product link: ' + productData.url);
                    }
                }
            } else {
                alert('Share this product: ' + productData.url);
            }
        }
    }">
        <button @click.prevent.stop='shareProduct'
            class='btn btn-circle btn-xs bg-base-100/90 backdrop-blur-sm hover:bg-base-100 hover:scale-110 border-0 shadow-lg transition-all duration-200 tooltip tooltip-left'
            data-tip='Share' aria-label='Share product'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2'
                stroke='currentColor' class='size-3'>
                <path stroke-linecap='round' stroke-linejoin='round'
                    d='M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z' />
            </svg>
        </button>
    </div>

    {{-- Main clickable area --}}
    <a wire:navigate href="{{ route('product.show', $product->slug) }}" class="contents">
        <figure class="relative aspect-square overflow-hidden bg-base-200 flex-shrink-0 rounded-t-2xl">
            @if ($firstImage && $firstImage->image_path)
                <img src="{{ Storage::url($firstImage->image_path) }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    loading="lazy" alt="{{ $product->name }}" />
            @else
                <img src="{{ asset('icons/noimage.png') }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    loading="lazy" alt="{{ $product->name }}" />
            @endif

            {{-- Compact badges --}}
            <div class="absolute top-2 left-2 flex flex-col gap-1 z-10">
                @if ($product->sale_price && $product->is_on_sale)
                    <div class="bg-error text-error-content text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                        @if ($discountPercent > 0)
                            -{{ $discountPercent }}%
                        @else
                            SALE
                        @endif
                    </div>
                @endif
                @if ($product->is_new)
                    <div class="bg-success text-success-content text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                        NEW
                    </div>
                @endif
                @if ($product->is_featured && !($product->sale_price && $product->is_on_sale) && !$product->is_new)
                    <div class="bg-warning text-warning-content text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                        HOT
                    </div>
                @endif
                @if ($showLowStock && $product->stock <= $lowStockThreshold)
                    <div class="bg-warning text-warning-content text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                        Low Stock{{ $showStockNumber ? ': ' . $product->stock : '' }}
                    </div>
                @endif
                @if ($showStockNumber && (!$showLowStock || $product->stock > $lowStockThreshold))
                    <div class="bg-info text-info-content text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
                        In Stock: {{ $product->stock }}
                    </div>
                @endif
            </div>
        </figure>

        <div class="p-3 flex flex-col flex-grow">
            @if ($product->category)
                <div class="flex items-center gap-1 mb-1">
                    <div class="w-1.5 h-1.5 rounded-full bg-primary/60"></div>
                    <span class="text-xs text-base-content/60 font-medium uppercase tracking-wide">
                        {{ $product->category->name }}
                    </span>
                </div>
            @endif

            <h3
                class="text-sm font-bold text-base-content line-clamp-2 leading-snug mb-1 group-hover:text-primary transition-colors duration-300">
                {{ $product->name }}
            </h3>

            <p class="text-xs text-base-content/70 line-clamp-2 leading-tight mb-2">
                {{ $product->description }}
            </p>

            @if ($product->tags && $product->tags->count() > 0)
                <div class="flex flex-wrap gap-1 mb-2">
                    @foreach ($product->tags->take(2) as $tag)
                        <span class="bg-base-200 text-base-content/70 text-xs px-2 py-0.5 rounded-full">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                    @if ($product->tags->count() > 2)
                        <span class="bg-base-200/60 text-base-content/50 text-xs px-2 py-0.5 rounded-full">
                            +{{ $product->tags->count() - 2 }}
                        </span>
                    @endif
                </div>
            @endif

            <div class="flex items-baseline gap-1 mt-auto mb-2">
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

    {{-- Compact action buttons --}}
    <div class="p-3 pt-0 flex gap-2">
        <button wire:click="addToCart"
            class="btn btn-primary btn-sm flex-1 rounded-full text-xs h-8 min-h-8 shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-200">
            Add
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="size-3">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
        </button>

        <button wire:click="toggleWishlist"
            class="btn btn-circle btn-sm h-8 w-8 min-h-8 rounded-full shadow-sm hover:shadow-md hover:scale-110 transition-all duration-200 {{ $isInWishlist ? 'btn-error text-error-content' : 'btn-neutral hover:text-error' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $isInWishlist ? 'currentColor' : 'none' }}"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>
    </div>
</div>
