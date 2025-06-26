@props(['product' => [], 'isInWishlist' => false, 'quantity' => 1]) {{-- Added isInWishlist and quantity for completeness of props --}}
@php
    $firstImage = $product->firstSortedImage;
    $hasImages = $product->images->count() > 0;
    $discountPercent =
        $product->is_on_sale && $product->sale_price
            ? round((($product->price - $product->sale_price) / $product->price) * 100)
            : 0;
@endphp

<div class="min-h-screen bg-gradient-to-br from-base-100 to-base-200" x-data="{
    currentImage: @if ($hasImages) '{{ Storage::url($firstImage->image_path) }}' @else '' @endif,
    showModal: false,
    currentIndex: 0,
    showSpecs: false,
    {{-- This prop is not used in the Alpine.js data, might be for Livewire component --}}
    images: @if ($hasImages) [
        @foreach ($product->images->sortBy('sort') as $image)
            '{{ Storage::url($image->image_path) }}',
        @endforeach
    ] @else [] @endif,
    nextImage() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.currentImage = this.images[this.currentIndex];
    },
    prevImage() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        this.currentImage = this.images[this.currentIndex];
    },
    selectImage(index) {
        this.currentIndex = index;
        this.currentImage = this.images[index];
    }
}" x-init="// Auto-advance images every 5 seconds when multiple images exist
@if ($product->images->count() > 1) setInterval(() => {
    if (!showModal) nextImage();
}, 5000); @endif">

    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="breadcrumbs text-sm mb-8 animate-fade-in">
            <ul class="flex-wrap">
                <li>
                    <a href="/"
                        class="text-primary/80 hover:text-primary transition-colors duration-200 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>
                </li>
                <li><a href="{{ route('products') }}"
                        class="text-primary/80 hover:text-primary transition-colors duration-200">Products</a></li>
                @if ($product->category)
                    <li><a href="{{ route('products', ['c' => $product->category->slug]) }}"
                            class="text-primary/80 hover:text-primary transition-colors duration-200">{{ $product->category->name }}</a>
                    </li>
                @endif
                <li class="text-base-content/60 truncate max-w-[150px] md:max-w-none">{{ $product->name }}</li>
            </ul>
        </div>

        {{-- IMPORTANT: Added lg:items-start to the grid container --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16 lg:items-start">
            @if ($hasImages)
                {{-- IMPORTANT: Added lg:sticky lg:top-8 and lg:self-start --}}
                <div class="relative animate-slide-in-left lg:sticky lg:top-8 lg:self-start">
                    @if ($product->is_on_sale && $product->sale_price && $discountPercent > 0)
                        <div class="absolute top-4 left-4 z-20">
                            <div class="badge badge-error badge-lg font-bold text-white shadow-lg animate-bounce">
                                -{{ $discountPercent }}% OFF
                            </div>
                        </div>
                    @endif

                    <div class="absolute top-4 right-4 z-20 flex flex-col gap-2">
                        @if ($product->is_new)
                            <span class="badge badge-accent badge-sm font-bold shadow-lg animate-pulse">NEW</span>
                        @endif
                        @if ($product->is_featured)
                            <span class="badge badge-secondary badge-sm font-bold shadow-lg">FEATURED</span>
                        @endif
                    </div>

                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-base-100 to-base-200 rounded-3xl overflow-hidden shadow-2xl backdrop-blur-sm border border-white/20 cursor-zoom-in hover:shadow-3xl transition-all duration-500"
                            @click="showModal = true">
                            <img x-bind:src="currentImage" alt="{{ $product->name }}"
                                class="w-full h-full object-contain hover:scale-105 transition-transform duration-700" />

                            @if ($product->images->count() > 1)
                                <button @click.stop="prevImage"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 btn btn-circle btn-primary btn-sm shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button @click.stop="nextImage"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 btn btn-circle btn-primary btn-sm shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            @endif
                        </div>

                        @if ($product->images->count() > 1)
                            <div
                                class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/50 backdrop-blur-sm rounded-full px-3 py-1 text-white text-xs">
                                <span x-text="currentIndex + 1"></span> / {{ $product->images->count() }}
                            </div>
                        @endif
                    </div>

                    @if ($product->images->count() > 1)
                        <div class="mt-6 flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                            @foreach ($product->images->sortBy('sort') as $index => $image)
                                <button @click="selectImage({{ $index }})"
                                    class="flex-shrink-0 w-20 h-20 rounded-2xl overflow-hidden border-2 transition-all duration-300 hover:scale-105 hover:shadow-lg"
                                    :class="{
                                        'border-primary shadow-lg scale-105': currentIndex ===
                                            {{ $index }},
                                        'border-base-300 hover:border-primary/50': currentIndex !==
                                            {{ $index }}
                                    }">
                                    <img src="{{ Storage::url($image->image_path) }}"
                                        alt="{{ $product->name }} thumbnail" class="w-full h-full object-cover" />
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <div class="animate-slide-in-right">
                <div class="mb-6">
                    <h1
                        class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-2">
                        {{ $product->name }}
                    </h1>
                    @if ($product->category)
                        <a href="{{ route('products', ['c' => $product->category->slug]) }}"
                            class="text-primary hover:text-primary-focus transition-colors duration-200 text-lg font-medium flex items-center gap-2 w-fit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            {{ $product->category->name }}
                        </a>
                    @endif
                </div>

                <div
                    class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-3xl p-6 mb-8 border border-primary/20">
                    <div class="flex items-center justify-between">
                        <div>
                            @if ($product->is_on_sale && $product->sale_price)
                                <div class="flex items-baseline gap-3">
                                    <span
                                        class="text-4xl font-bold text-primary">${{ number_format($product->sale_price, 2) }}</span>
                                    <span
                                        class="text-xl text-base-content/50 line-through">${{ number_format($product->price, 2) }}</span>
                                </div>
                                <div class="text-success font-medium mt-1">You save
                                    ${{ number_format($product->price - $product->sale_price, 2) }}!</div>
                            @else
                                <span
                                    class="text-4xl font-bold text-primary">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($product->sku || $product->weight || ($product->width && $product->height && $product->depth))
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-base-content">Product Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @if ($product->sku)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-base-200">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <div>
                                        <div class="text-xs text-base-content/60">SKU</div>
                                        <div class="font-medium">{{ $product->sku }}</div>
                                    </div>
                                </div>
                            @endif

                            @if ($product->weight)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-base-200">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                    </svg>
                                    <div>
                                        <div class="text-xs text-base-content/60">Weight</div>
                                        <div class="font-medium">{{ $product->weight }} kg</div>
                                    </div>
                                </div>
                            @endif

                            @if ($product->width)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-base-200">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <div class="text-xs text-base-content/60">Width</div>
                                        <div class="font-medium">{{ $product->width }} cm</div>
                                    </div>
                                </div>
                            @endif

                            @if ($product->height)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-base-200">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <div class="text-xs text-base-content/60">Height</div>
                                        <div class="font-medium">{{ $product->height }} cm</div>
                                    </div>
                                </div>
                            @endif

                            @if ($product->depth)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-base-200">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <div class="text-xs text-base-content/60">Depth</div>
                                        <div class="font-medium">{{ $product->depth }} cm</div>
                                    </div>
                                </div>
                            @endif

                            @if ($product->barcode)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-base-200">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div>
                                        <div class="text-xs text-base-content/60">Barcode</div>
                                        <div class="font-medium">{{ $product->barcode }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($product->is_new || $product->is_featured || $product->is_on_sale)
                            <div class="mt-6">
                                <h4 class="text-md font-semibold mb-3 text-base-content">Product Status</h4>
                                <div class="flex flex-wrap gap-2">
                                    @if ($product->is_new)
                                        <span class="badge badge-accent badge-lg font-bold">NEW</span>
                                    @endif
                                    @if ($product->is_featured)
                                        <span class="badge badge-secondary badge-lg font-bold">FEATURED</span>
                                    @endif
                                    @if ($product->is_on_sale)
                                        <span class="badge badge-error badge-lg font-bold">SALE</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if ($product->brief_description)
                    <div class="prose max-w-none mb-8">
                        {!! Str::markdown($product->brief_description) !!}
                    </div>
                @endif

                @if ($product->tags->count() > 0)
                    <div class="mb-8">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($product->tags as $tag)
                                <span
                                    class="badge badge-outline badge-lg hover:badge-primary transition-all duration-300 cursor-pointer">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center gap-2">
                        <button wire:click="decrementQuantity" class="btn btn-circle btn-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <span class="text-lg font-medium w-8 text-center">{{ $quantity }}</span>
                        <button wire:click="incrementQuantity" class="btn btn-circle btn-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                    <button wire:click="addToCart" wire:loading.attr="disabled" class="btn btn-primary flex-1 gap-2">
                        <span wire:loading.remove>Add to Cart</span>
                        <span wire:loading class="loading loading-spinner loading-sm"></span>
                    </button>
                    <button wire:click="toggleWishlist"
                        class="btn btn-ghost btn-circle {{ $isInWishlist ? 'text-primary' : '' }}">
                        <svg class="w-6 h-6" fill="{{ $isInWishlist ? 'currentColor' : 'none' }}"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                    <div class="flex items-center gap-2 p-3 rounded-2xl bg-base-200">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm font-medium">Quality Checked</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 rounded-2xl bg-base-200">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">Fast Delivery</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 rounded-2xl bg-base-200">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span class="text-sm font-medium">Secure Payment</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 rounded-2xl bg-base-200">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span class="text-sm font-medium">24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-base-100 rounded-3xl shadow-xl border border-base-300 overflow-hidden">
            <div class="tabs tabs-lifted w-full">
                <input type="radio" name="product_tabs" class="tab" aria-label="Description" checked />
                <div class="tab-content bg-base-100 border-base-300 rounded-box p-8">
                    @if ($product->description)
                        <div class="prose prose-lg max-w-none">
                            {!! Str::markdown($product->description) !!}
                        </div>
                    @else
                        <p class="text-base-content/70">No detailed description available.</p>
                    @endif
                </div>

                <input type="radio" name="product_tabs" class="tab" aria-label="Specifications" />
                <div class="tab-content bg-base-100 border-base-300 rounded-box p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if ($product->sku)
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-base-200">
                                <svg class="w-8 h-8 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <div>
                                    <div class="text-sm text-base-content/70 font-medium">SKU</div>
                                    <div class="text-lg font-bold">{{ $product->sku }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($product->barcode)
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-base-200">
                                <svg class="w-8 h-8 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <div>
                                    <div class="text-sm text-base-content/70 font-medium">Barcode</div>
                                    <div class="text-lg font-bold">{{ $product->barcode }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($product->weight)
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-base-200">
                                <svg class="w-8 h-8 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                                <div>
                                    <div class="text-sm text-base-content/70 font-medium">Weight</div>
                                    <div class="text-lg font-bold">{{ $product->weight }} kg</div>
                                </div>
                            </div>
                        @endif

                        @if ($product->width && $product->height && $product->depth)
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-base-200">
                                <svg class="w-8 h-8 text-primary flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <div class="text-sm text-base-content/70 font-medium">Dimensions</div>
                                    <div class="text-lg font-bold">{{ $product->width }} × {{ $product->height }} ×
                                        {{ $product->depth }} cm</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <input type="radio" name="product_tabs" class="tab" aria-label="Reviews" />
                <div class="tab-content bg-base-100 border-base-300 rounded-box p-8">
                    <p class="text-base-content/70">Reviews coming soon...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12 max-w-7xl">
        <div class="mb-8">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                Related Products
            </h2>
            <p class="text-base-content/70 mt-2">You might also like these products</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($this->getRelatedProducts() as $relatedProduct)
                <livewire:product-card :product="$relatedProduct" :key="$relatedProduct->id" />
            @endforeach
        </div>
    </div>

    <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] bg-black/90 backdrop-blur-sm flex items-center justify-center"
        @click.self="showModal = false">
        <div class="relative max-w-7xl w-full h-full flex items-center justify-center p-4">
            <img x-bind:src="currentImage" alt="{{ $product->name }}"
                class="max-w-full max-h-full object-contain" />
            <button @click="showModal = false"
                class="absolute top-4 right-4 btn btn-circle btn-ghost text-white hover:bg-white/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            @if ($product->images->count() > 1)
                <button @click.stop="prevImage"
                    class="absolute left-4 top-1/2 -translate-y-1/2 btn btn-circle btn-ghost text-white hover:bg-white/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click.stop="nextImage"
                    class="absolute right-4 top-1/2 -translate-y-1/2 btn btn-circle btn-ghost text-white hover:bg-white/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @endif
        </div>
    </div>
</div>
