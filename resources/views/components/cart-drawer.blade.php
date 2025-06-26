@php
    $cartService = app(App\Services\CartService::class);
    $cartSummary = $cartService->getCartSummary();
    $cartCount = $cartSummary['total_items'] ?? 0;
@endphp

<div x-data="{ open: false, count: {{ $cartCount }} }" @cart-updated.window="open = true; count = $event.detail.count"
    @cart-count-updated.window="count = $event.detail.count">
    <!-- Cart Button -->
    <button @click="open = true" class="btn btn-ghost btn-circle">
        <div class="indicator">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="badge badge-sm indicator-item" x-text="count"></span>
        </div>
    </button>

    <!-- Cart Drawer -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-full"
        class="fixed inset-y-0 right-0 w-full max-w-md bg-base-100 shadow-xl z-45" @click.away="open = false"
        @keydown.escape.window="open = false">

        <div class="h-full flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h2 class="text-lg font-semibold">Shopping Cart</h2>
                <button @click="open = false" class="btn btn-ghost btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Cart Content -->
            <div class="flex-1 overflow-y-auto p-4 h-full">
                <livewire:cart />
            </div>
        </div>
    </div>
</div>
