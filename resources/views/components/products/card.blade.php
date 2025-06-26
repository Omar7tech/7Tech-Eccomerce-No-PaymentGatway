
@props(['product' => []])
<div class="card bg-base-100 shadow-sm hover:shadow-md transition-all duration-200 h-full flex flex-col rounded-box overflow-hidden group border border-base-200 hover:border-primary/30">
    <!-- Image Section -->
    <figure class="relative aspect-square overflow-hidden bg-base-200 flex-shrink-0">
       {{--  <img src="https://placehold.co/600x600?text=Product" alt="Product"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" /> --}}

        <!-- Sale Badge -->
        @if ($product->sale_price)
            <div class="absolute top-2 left-2 badge badge-primary badge-sm text-primary-content font-bold">
                SALE
            </div>
        @endif
    </figure>

    <!-- Content Section -->
    <div class="p-3 flex flex-col flex-grow">
        <!-- Title -->
        <h3 class="text-sm font-semibold text-base-content line-clamp-2 leading-tight mb-1">
            {{ $product->name }}
        </h3>

        <!-- Description -->
        <p class="text-xs text-base-content/60 line-clamp-2 leading-tight mb-2">
            {{ $product->description }}
        </p>




        <!-- Price -->
        <div class="flex items-baseline gap-1 mt-auto">
            @if ($product->sale_price)
                <span class="text-sm font-bold text-primary">${{ $product->sale_price }}</span>
                <span class="text-xs text-base-content/50 line-through">${{ $product->price }}</span>
            @else
                <span class="text-sm font-bold text-primary">${{ $product->price }}</span>
            @endif
        </div>

        <!-- Add to Cart -->
        <button wire:click='test("{{ $product->slug }}")'
                class="btn btn-primary btn-sm w-full mt-2 text-xs py-1 h-8 min-h-8">
            Add to Cart
        </button>
    </div>
</div>
