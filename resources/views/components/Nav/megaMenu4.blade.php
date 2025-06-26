<div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-3 w-screen max-w-4xl bg-base-100/95 backdrop-blur-xl shadow-2xl rounded-3xl border border-base-300/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-500 ease-out z-50 overflow-hidden">
    {{-- Decorative background elements --}}
    <div class="absolute inset-0 bg-gradient-to-br from-primary/3 via-transparent to-secondary/3"></div>
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary via-secondary to-accent"></div>

    {{-- Floating particles effect --}}
    <div class="absolute top-4 right-8 w-2 h-2 bg-primary/20 rounded-full animate-pulse delay-75"></div>
    <div class="absolute top-12 right-16 w-1 h-1 bg-secondary/30 rounded-full animate-pulse delay-150"></div>
    <div class="absolute top-6 right-24 w-1.5 h-1.5 bg-accent/25 rounded-full animate-pulse delay-300"></div>

    <div class="relative p-6">
        {{-- Enhanced Header with Stats --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-content" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-success rounded-full flex items-center justify-center">
                        <span class="text-success-content text-xs font-bold">{{ count($categories) }}</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-base-content mb-1">Explore Categories</h3>
                    <p class="text-sm text-base-content/60">Discover products across all categories</p>
                </div>
            </div>

            <a wire:navigate href="{{ route('categories') }}"
                class="btn btn-ghost btn-sm gap-2 hover:btn-primary group/btn">
                <span class="text-sm font-medium">View All</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover/btn:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        @if (count($categories) > 0)
            {{-- Advanced Categories Layout --}}
            <div class="space-y-4">
                {{-- Featured Categories (First 4) --}}
                @if (count($categories) >= 4)
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-1 h-4 bg-gradient-to-b from-primary to-secondary rounded-full"></div>
                            <span class="text-xs font-semibold text-primary uppercase tracking-wider">Featured</span>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                            @foreach ($categories->take(4) as $index => $category)
                                <a href="{{ route('products', ['category' => $category->slug]) }}"
                                    class="group/featured relative overflow-hidden bg-gradient-to-br from-base-200/50 to-base-300/30 hover:from-primary/10 hover:to-secondary/10 rounded-2xl border border-base-300/40 hover:border-primary/40 transition-all duration-300 hover:shadow-xl hover:shadow-primary/10 hover:-translate-y-1 transform"
                                    style="animation-delay: {{ $index * 50 }}ms;">

                                    <div class="p-4 text-center relative z-10">
                                        {{-- Enhanced Category Image/Icon --}}
                                        <div class="flex justify-center mb-3">
                                            @if ($category->image)
                                                <div class="relative">
                                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                                        class="h-12 w-12 rounded-xl object-cover group-hover/featured:scale-110 transition-all duration-300 shadow-lg">
                                                    <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover/featured:opacity-100 transition-opacity duration-300"></div>
                                                </div>
                                            @else
                                                <div class="h-12 w-12 bg-gradient-to-br from-primary via-secondary to-accent rounded-xl flex items-center justify-center group-hover/featured:scale-110 group-hover/featured:rotate-3 transition-all duration-300 shadow-lg">
                                                    <span class="text-primary-content text-sm font-bold">{{ substr($category->name, 0, 2) }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <h4 class="font-semibold text-sm text-base-content group-hover/featured:text-primary transition-colors duration-300 mb-1 line-clamp-1">
                                            {{ $category->name }}
                                        </h4>
                                        @if ($category->description)
                                            <p class="text-xs text-base-content/50 group-hover/featured:text-base-content/70 transition-colors duration-300 line-clamp-2">
                                                {{ Str::limit($category->description, 40) }}
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Hover effect overlay --}}
                                    <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-secondary/5 opacity-0 group-hover/featured:opacity-100 transition-opacity duration-300"></div>

                                    {{-- Animated border --}}
                                    <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover/featured:border-primary/20 transition-colors duration-300"></div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Remaining Categories in Compact List --}}
                @if (count($categories) > 4)
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-1 h-4 bg-gradient-to-b from-secondary to-accent rounded-full"></div>
                            <span class="text-xs font-semibold text-secondary uppercase tracking-wider">All Categories</span>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                            @foreach ($categories->skip(4)->take(8) as $index => $category)
                                <a href="{{ route('products', ['category' => $category->slug]) }}"
                                    class="group/compact flex items-center gap-3 p-3 rounded-xl hover:bg-gradient-to-r hover:from-base-200/80 hover:to-base-300/40 transition-all duration-200 border border-transparent hover:border-base-300/60"
                                    style="animation-delay: {{ ($index + 4) * 30 }}ms;">

                                    @if ($category->image)
                                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                            class="h-8 w-8 rounded-lg object-cover group-hover/compact:scale-105 transition-transform duration-200 flex-shrink-0">
                                    @else
                                        <div class="h-8 w-8 bg-gradient-to-br from-neutral to-base-300 rounded-lg flex items-center justify-center group-hover/compact:scale-105 transition-transform duration-200 flex-shrink-0">
                                            <span class="text-neutral-content text-xs font-medium">{{ substr($category->name, 0, 2) }}</span>
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <h5 class="font-medium text-xs text-base-content group-hover/compact:text-primary transition-colors duration-200 truncate">
                                            {{ $category->name }}
                                        </h5>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Enhanced Footer --}}
            @if (count($categories) > 12)
                <div class="mt-6 pt-4 border-t border-base-300/50">
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-base-content/60">
                            Showing 12 of {{ count($categories) }} categories
                        </div>
                        <a wire:navigate href="{{ route('categories') }}"
                            class="btn btn-primary btn-sm gap-2 shadow-lg hover:shadow-xl transition-shadow duration-200">
                            <span>Explore All Categories</span>
                            <div class="badge badge-primary-content badge-sm">{{ count($categories) }}</div>
                        </a>
                    </div>
                </div>
            @endif
        @else
            {{-- Enhanced Empty State --}}
            <div class="text-center py-12">
                <div class="relative mb-4">
                    <div class="h-16 w-16 bg-gradient-to-br from-base-200 to-base-300 rounded-2xl flex items-center justify-center mx-auto shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <h4 class="font-semibold text-base-content mb-2">No Categories Found</h4>
                <p class="text-sm text-base-content/60">Check back later for new product categories.</p>
            </div>
        @endif
    </div>

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .group:hover [style*="animation-delay"] {
            animation: slideInUp 0.4s ease-out forwards;
        }

        /* Enhanced backdrop blur support */
        @supports not (backdrop-filter: blur(24px)) {
            .backdrop-blur-xl {
                background-color: rgba(255, 255, 255, 0.98);
            }
            [data-theme="dark"] .backdrop-blur-xl {
                background-color: rgba(0, 0, 0, 0.98);
            }
        }
    </style>
</div>
