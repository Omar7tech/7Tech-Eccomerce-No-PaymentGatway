<div>
    <div class="card bg-gradient-to-br from-base-100 to-base-200 shadow-2xl border border-base-300/20 max-w-4xl mx-auto">
        <div class="card-body p-4 relative">
            <!-- Compact Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-xs text-primary-content"></i>
                    </div>
                    Cart <span class="badge badge-primary badge-sm">{{ count($cartItems) }}</span>
                </h2>
                @if (count($cartItems) > 0)
                    <button wire:click="clearCart" class="btn btn-ghost btn-xs text-error hover:bg-error/10">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                @endif
            </div>

            @if ($errorMessage)
                <div class="alert alert-error mb-4">
                    <span>{{ $errorMessage }}</span>
                </div>
            @endif

            @if (count($cartItems) > 0)
                <div class="space-y-4">
                    <!-- Cart Items -->
                    @foreach ($cartItems as $item)
                        <div
                            class="card bg-base-100 shadow-sm hover:shadow-md border border-base-300/30 transition-all duration-200 group">
                            <div class="card-body p-3">
                                <!-- Mobile-First Layout: Stack on small screens, side-by-side on larger -->
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <!-- Product Image and Basic Info Row -->
                                    <div class="flex items-start gap-3 flex-1">
                                        <!-- Product Image -->
                                        <div class="relative flex-shrink-0">
                                            <div class="w-20 h-20 sm:w-16 sm:h-16 rounded-lg overflow-hidden shadow-sm">
                                                <img src="{{ $item['product']->firstSortedImage?->image_path ? Storage::url($item['product']->firstSortedImage->image_path) : 'https://placehold.co/600x600?text=' . urlencode($item['product']->name) }}"
                                                    alt="{{ $item['product']->name }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                            </div>
                                            @if ($item['product']->is_on_sale && $item['product']->sale_price)
                                                <div
                                                    class="absolute -top-1 -right-1 w-5 h-5 sm:w-4 sm:h-4 bg-error rounded-full flex items-center justify-center">
                                                    <span class="text-xs text-error-content font-bold">%</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 min-w-0">
                                            <!-- Product Name - Better spacing and no truncation -->
                                            <h3
                                                class="font-medium text-base sm:text-sm leading-snug mb-2 group-hover:text-primary transition-colors">
                                                {{ $item['product']->name }}
                                            </h3>

                                            <!-- Category -->
                                            <div class="text-sm sm:text-xs text-base-content/60 mb-2">
                                                {{ $item['product']->category->name }}
                                            </div>

                                            <!-- Price Display -->
                                            <div class="flex items-center gap-2 mb-3">
                                                @if ($item['product']->is_on_sale && $item['product']->sale_price)
                                                    <span class="text-base sm:text-sm font-bold text-success">
                                                        ${{ number_format($item['product']->sale_price, 2) }}
                                                    </span>
                                                    <span class="text-sm sm:text-xs text-base-content/50 line-through">
                                                        ${{ number_format($item['product']->price, 2) }}
                                                    </span>
                                                @else
                                                    <span class="text-base sm:text-sm font-bold text-primary">
                                                        ${{ number_format($item['product']->price, 2) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Controls Section - Better mobile layout -->
                                    <div
                                        class="flex items-center justify-between sm:flex-col sm:items-end gap-3 sm:gap-2">
                                        <!-- See Product Button - Full width on mobile -->
                                        <a wire:navigate href="{{ route('product.show', $item['product']->slug) }}"
                                            class="btn btn-sm sm:btn-xs btn-outline btn-primary flex-1 sm:flex-none sm:w-auto">
                                            <i class="fas fa-eye text-xs mr-1 sm:hidden"></i>
                                            <span class="sm:text-xs">See Product</span>
                                        </a>

                                        <!-- Quantity and Remove Controls -->
                                        <div class="flex items-center gap-2">
                                            <!-- Quantity Controls -->
                                            <div class="flex items-center gap-1 bg-base-200 rounded-full p-1">
                                                <button
                                                    wire:click="updateQuantity({{ $item['product']->id }}, {{ $item['quantity'] - 1 }})"
                                                    class="btn btn-xs btn-circle btn-ghost hover:btn-error"
                                                    @if ($item['quantity'] <= 1) disabled @endif>
                                                    <span wire:loading.flex
                                                        wire:target="updateQuantity({{ $item['product']->id }},{{ $item['quantity'] - 1 }})"
                                                        class="absolute inset-0 flex items-center justify-center bg-base-100/80 z-10 rounded-lg">
                                                        <span
                                                            class="loading loading-spinner loading-xs text-primary"></span>
                                                    </span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="3">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M20 12H4" />
                                                    </svg>
                                                </button>

                                                <span
                                                    class="w-8 text-center text-sm font-medium px-1">{{ $item['quantity'] }}</span>

                                                <button
                                                    wire:click="updateQuantity({{ $item['product']->id }}, {{ $item['quantity'] + 1 }})"
                                                    class="btn btn-xs btn-circle btn-ghost hover:btn-success">
                                                    <span wire:loading.flex
                                                        wire:target="updateQuantity({{ $item['product']->id }},{{ $item['quantity'] + 1 }})"
                                                        class="absolute inset-0 flex items-center justify-center bg-base-100/80 z-10 rounded-lg">
                                                        <span
                                                            class="loading loading-spinner loading-xs text-primary"></span>
                                                    </span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="3">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Remove Button -->
                                            <button wire:click="removeItem({{ $item['product']->id }})"
                                                class="btn btn-xs btn-circle btn-ghost text-error hover:btn-error hover:text-error-content tooltip tooltip-left"
                                                data-tip="Remove">
                                                <span wire:loading.flex
                                                    wire:target="removeItem({{ $item['product']->id }})"
                                                    class="absolute inset-0 flex items-center justify-center bg-base-100/80 z-10 rounded-lg">
                                                    <span
                                                        class="loading loading-spinner loading-xs text-primary"></span>
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Cart Summary -->
                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-4">
                            <!-- Summary Grid -->
                            <div class="gap-2 text-sm mb-3">
                                <div class="flex justify-between">
                                    <span class="text-base-content/70">Items:</span>
                                    <span class="font-medium">{{ $totalItems }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-base-content/70">Delivery:</span>
                                    <span
                                        class="{{ $cartSettings['deliveryFree'] ? 'text-success' : 'text-base-content' }} font-medium">{{ $cartSettings['deliveryPriceText'] }}</span>
                                </div>
                            </div>

                            <div class="divider my-2"></div>

                            <!-- Total -->
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-lg font-semibold">Total:</span>
                                <span class="text-lg font-semibold">${{ number_format($total, 2) }}</span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-2">
                                <div class="space-y-2">
                                    @if ($cartSettings['cashOnDeliveryActive'] && $cartSettings['cashOnDeliveryWhatsappNumber'])
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cartSettings['cashOnDeliveryWhatsappNumber']) }}?text={{ urlencode(
                                            'Hello! I would like to place an order for cash on delivery. Here are my order details:' .
                                                PHP_EOL .
                                                PHP_EOL .
                                                'Order Items:' .
                                                PHP_EOL .
                                                collect($cartItems)->map(function ($item) {
                                                        $price = $item['product']->is_on_sale ? $item['product']->sale_price : $item['product']->price;
                                                        $subtotal = $price * $item['quantity'];
                                                        return '- ' .
                                                            $item['product']->name .
                                                            ' x' .
                                                            $item['quantity'] .
                                                            ' ($' .
                                                            number_format($price, 2) .
                                                            ') = $' .
                                                            number_format($subtotal, 2);
                                                    })->join(PHP_EOL) .
                                                PHP_EOL .
                                                PHP_EOL .
                                                'Subtotal: $' .
                                                number_format($total - $cartSettings['deliveryPrice'], 2) .
                                                PHP_EOL .
                                                'Delivery: ' .
                                                $cartSettings['deliveryPriceText'] .
                                                PHP_EOL .
                                                'Total Items: ' .
                                                $totalItems .
                                                PHP_EOL .
                                                'Total Amount: $' .
                                                number_format($total, 2),
                                        ) }}"
                                            target="_blank"
                                            class="btn bg-[#5EBB2B] border-[#4eaa0c] w-full text-white hover:bg-[#4eaa0c]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                            </svg>
                                            <span class="hidden sm:inline">Cash on Delivery</span>
                                            <span class="sm:hidden">Order via WhatsApp</span>
                                        </a>
                                    @endif
                                </div>
                                <button wire:click="clearCart" class="btn btn-ghost w-full text-error">
                                    <span wire:loading.flex wire:target="clearCart"
                                        class="absolute inset-0 flex items-center justify-center bg-base-100/80 z-10 rounded-lg">
                                        <span class="loading loading-spinner loading-xs text-primary"></span>
                                    </span>
                                    Clear Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Compact Empty State -->
                <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto mb-4 bg-base-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-2xl text-base-content/30"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Cart is empty</h3>
                    <p class="text-sm text-base-content/70 mb-4">Add products to get started</p>
                    <a href="{{ route('products') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus text-xs mr-1"></i>
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Custom animations and effects */
        .card:hover {
            transform: translateY(-1px);
        }

        .btn:active {
            transform: scale(0.95);
        }

        .avatar .ring-2 {
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        /* Smooth transitions */
        * {
            transition: all 0.2s ease;
        }

        /* Mobile-specific improvements */
        @media (max-width: 640px) {
            .card-body {
                padding: 0.75rem;
            }

            /* Ensure text doesn't get cramped */
            h3 {
                line-height: 1.3;
                word-wrap: break-word;
                overflow-wrap: break-word;
            }

            /* Better button spacing on mobile */
            .btn {
                min-height: 2.5rem;
            }
        }
    </style>
</div>
