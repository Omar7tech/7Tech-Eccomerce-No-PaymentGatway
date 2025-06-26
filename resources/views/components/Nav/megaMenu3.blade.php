<div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-screen max-w-3xl bg-base-100 shadow-xl rounded-2xl border border-base-300/50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out z-50 overflow-hidden">
    {{-- Animated background gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

    <div class="relative p-4">
        {{-- Simplified Header --}}
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <div class="w-1 h-5 bg-gradient-to-b from-primary to-secondary rounded-full"></div>
                <h3 class="text-base font-bold text-base-content">Browse Categories</h3>
            </div>

            <a wire:navigate href="{{ route('categories') }}"
                class="text-primary hover:text-primary-focus text-xs font-medium flex items-center gap-1 group/btn">
                <span>View All</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 group-hover/btn:translate-x-0.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        @if (count($categories) > 0)
            {{-- Compact Categories Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($categories->take(12) as $index => $category)
                    <a href="{{ route('products', ['category' => $category->slug]) }}"
                        class="group/card relative overflow-hidden bg-base-200/30 hover:bg-gradient-to-br hover:from-primary/10 hover:to-secondary/10 rounded-xl border border-base-300/30 hover:border-primary/30 transition-all duration-200 hover:shadow-md hover:shadow-primary/5 hover:-translate-y-0.5"
                        style="animation-delay: {{ $index * 30 }}ms;">

                        {{-- Card content --}}
                        <div class="p-3 relative z-10">
                            {{-- Category Image/Icon --}}
                            <div class="flex justify-center mb-2">
                                @if ($category->image)
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                        class="h-8 w-8 rounded-lg object-cover group-hover/card:scale-105 transition-transform duration-200 shadow-sm">
                                @else
                                    <div class="h-8 w-8 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center group-hover/card:scale-105 transition-all duration-200 shadow-sm">
                                        <span class="text-primary-content text-xs font-bold">{{ substr($category->name, 0, 2) }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Category Info --}}
                            <div class="text-center">
                                <h4 class="font-medium text-xs text-base-content group-hover/card:text-primary transition-colors duration-200 mb-1 line-clamp-2">
                                    {{ $category->name }}
                                </h4>
                                @if ($category->description)
                                    <p class="text-xs text-base-content/50 group-hover/card:text-base-content/60 transition-colors duration-200 line-clamp-1">
                                        {{ Str::limit($category->description, 30) }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Subtle shine effect --}}
                        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-transparent via-white/5 to-transparent transform -skew-x-12 -translate-x-full group-hover/card:translate-x-full transition-transform duration-500 ease-out"></div>
                    </a>
                @endforeach
            </div>

            {{-- Compact Footer Section --}}
            @if (count($categories) > 12)
                <div class="mt-4 pt-3 border-t border-base-300/50 text-center">
                    <a wire:navigate href="{{ route('categories') }}"
                        class="inline-flex items-center px-3 py-1.5 bg-primary text-primary-content rounded-lg hover:bg-primary-focus transition-colors duration-200 text-xs gap-1">
                        View All {{ count($categories) }} Categories
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @endif
        @else
            {{-- Compact Empty State --}}
            <div class="text-center py-8">
                <div class="h-12 w-12 rounded-full bg-base-200 flex items-center justify-center mx-auto mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-sm text-base-content/60">No categories available</p>
            </div>
        @endif
    </div>
    <style>
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.group:hover .group\/card {
    animation: slideInUp 0.3s ease-out forwards;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@supports not (backdrop-filter: blur(12px)) {
    .backdrop-blur-lg {
        background-color: rgba(255, 255, 255, 0.95);
    }
    [data-theme="dark"] .backdrop-blur-lg {
        background-color: rgba(0, 0, 0, 0.95);
    }
}
</style>

</div>

