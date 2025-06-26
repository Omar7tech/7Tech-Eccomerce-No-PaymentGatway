<div>
    <div class="min-h-screen bg-base-100">

        @if ($currentCategory)
            <div
                class="hero relative min-h-[300px] md:min-h-[350px] overflow-hidden bg-gradient-to-br from-primary/20 via-secondary/10 to-accent/20">

                <div
                    class="absolute inset-0 bg-gradient-to-br from-primary/10 via-secondary/5 to-accent/10 transform -skew-x-12 -translate-x-1/4">
                </div>


                @if ($currentCategory->image)
                    <div class="absolute inset-0">
                        <div class="absolute right-0 top-0 bottom-0 w-1/2 h-full overflow-hidden">
                            <img src="{{ Storage::url($currentCategory->image) }}" alt="{{ $currentCategory->name }}"
                                class="absolute inset-0 w-full h-full object-cover transform -skew-x-12 translate-x-1/4 opacity-10">
                        </div>
                    </div>
                @endif

                <div class="hero-content text-center max-w-4xl relative z-10 py-8 md:py-12">
                    <div>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-2 md:mb-4">
                            {{ $currentCategory->name }}</h1>
                        <p class="text-base md:text-lg opacity-80 mb-4 md:mb-6 max-w-2xl mx-auto">
                            {{ $currentCategory->description }}</p>
                        <button wire:click="clearCategory" class="btn btn-outline btn-primary btn-sm md:btn-md gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to All Products
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="hero bg-gradient-to-br from-primary/10 to-secondary/10 py-8 md:py-12">
                <div class="hero-content text-center">
                    <div>
                        <h1
                            class="text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-2 md:mb-4">
                            Our Products
                        </h1>
                        <p class="text-lg md:text-xl opacity-70">Discover amazing products just for you</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="container mx-auto px-4 py-8">
            <!-- Mobile Controls -->
            <div class="lg:hidden mb-6 flex gap-3">
                <div class="drawer drawer-end flex-1">
                    <input id="filter-drawer" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content">
                        <label for="filter-drawer" class="btn btn-outline flex-1 gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Filters
                        </label>
                    </div>
                    <div class="drawer-side z-50">
                        <label for="filter-drawer" class="drawer-overlay"></label>
                        <aside class="min-h-full w-80 bg-base-200 p-4">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold">Filters</h2>
                                <label for="filter-drawer" class="btn btn-sm btn-circle btn-ghost">✕</label>
                            </div>
                            @include('livewire.parts.product-filters')
                        </aside>
                    </div>
                </div>

                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-outline gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                        </svg>
                        Sort
                    </div>
                    <ul tabindex="0"
                        class="dropdown-content menu bg-base-100 rounded-box z-50 w-52 p-2 shadow-xl border">
                        <li><button wire:click="$set('sortBy', 'name')"
                                class="flex justify-between {{ $sortBy === 'name' ? 'active' : '' }}">Name <span
                                    class="badge badge-ghost badge-sm">{{ $sortBy === 'name' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' }}</span></button>
                        </li>
                        <li><button wire:click="$set('sortBy', 'price')"
                                class="flex justify-between {{ $sortBy === 'price' ? 'active' : '' }}">Price <span
                                    class="badge badge-ghost badge-sm">{{ $sortBy === 'price' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' }}</span></button>
                        </li>
                        <li><button wire:click="$set('sortBy', 'created_at')"
                                class="flex justify-between {{ $sortBy === 'created_at' ? 'active' : '' }}">Newest <span
                                    class="badge badge-ghost badge-sm">{{ $sortBy === 'created_at' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' }}</span></button>
                        </li>
                        <li><button wire:click="$set('sortBy', 'stock')"
                                class="flex justify-between {{ $sortBy === 'stock' ? 'active' : '' }}">Stock <span
                                    class="badge badge-ghost badge-sm">{{ $sortBy === 'stock' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' }}</span></button>
                        </li>
                        <div class="divider my-1"></div>
                        <li><button wire:click="$set('sortOrder', '{{ $sortOrder === 'asc' ? 'desc' : 'asc' }}')"
                                class="gap-2">
                                @if ($sortOrder === 'asc')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                    </svg>
                                    Ascending
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                    </svg>
                                    Descending
                                @endif
                            </button></li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <aside class="hidden lg:block w-80 shrink-0">
                    <div class="sticky top-20">
                        @include('livewire.parts.product-filters')
                    </div>
                </aside>

                <main class="flex-1 min-w-0 relative">
                    @include('components.products.filterTab')
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <div class="text-sm opacity-70">
                            <span class="font-medium">{{ $products->count() }}</span> of <span
                                class="font-medium">{{ $products->total() }}</span> products
                        </div>
                        <div class="hidden lg:flex items-center gap-3">
                            <span class="text-sm font-medium">Sort:</span>
                            <div class="join">
                                <select wire:model.live="sortBy" class="select select-bordered select-sm join-item">
                                    <option value="name">Name</option>
                                    <option value="price">Price</option>
                                    <option value="created_at">Newest</option>
                                    <option value="stock">Stock</option>
                                </select>
                                <button wire:click="$set('sortOrder', '{{ $sortOrder === 'asc' ? 'desc' : 'asc' }}')"
                                    class="btn btn-sm btn-outline join-item">
                                    @if ($sortOrder === 'asc')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                        </svg>
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                    <div wire:loading.delay class="flex justify-center items-center py-20">
                        <span class="loading loading-spinner loading-lg text-primary"></span>
                    </div>


                    <div wire:loading.remove>
                        @if ($products->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-12">
                                @foreach ($products as $product)
                                    <div wire:key="product-{{ $product->slug }}" class="product-card">
                                        <livewire:product-card lazy='on-load' :$product :key="$product->slug" />
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if ($products->hasPages())
                                <div class="flex justify-center mt-8">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        @else
                            <!-- Empty State (same as before) -->
                            <div class="text-center py-20">
                                <!-- ... existing empty state content ... -->
                            </div>
                        @endif

                    </div>
                </main>
            </div>
        </div>
    </div>

    <style>
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-4px);
        }

        .tab {
            transition: all 0.2s ease;
        }

        @media (max-width: 640px) {
            .tabs-boxed {
                flex-wrap: nowrap;
                overflow-x: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }

            .tabs-boxed::-webkit-scrollbar {
                display: none;
            }

            .tab {
                flex-shrink: 0;
            }
        }

        /* Smooth grid animations */
        .grid>div {
            animation: slideUp 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .grid>div:nth-child(1) {
            animation-delay: 0.1s;
        }

        .grid>div:nth-child(2) {
            animation-delay: 0.15s;
        }

        .grid>div:nth-child(3) {
            animation-delay: 0.2s;
        }

        .grid>div:nth-child(4) {
            animation-delay: 0.25s;
        }

        .grid>div:nth-child(5) {
            animation-delay: 0.3s;
        }

        .grid>div:nth-child(6) {
            animation-delay: 0.35s;
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar for webkit browsers */
        .overflow-x-auto::-webkit-scrollbar {
            height: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: hsl(var(--bc) / 0.2);
            border-radius: 2px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: hsl(var(--bc) / 0.3);
        }
    </style>

</div>
