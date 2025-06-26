<div
    class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-screen max-w-3xl bg-base-100 shadow-xl rounded-2xl border border-base-300 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out z-50">
    <div class="p-4">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-base-content">Browse Categories</h3>
            <a wire:navigate href="{{ route('categories') }}"
                class="text-primary hover:text-primary-focus text-sm font-medium">
                View All →
            </a>
        </div>

        @if (count($categories) > 0)
            {{-- Categories Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($categories->take(12) as $category)
                    <a href="{{ route('products', ['category' => $category->slug]) }}"
                        class="group/item flex items-center p-2 rounded-xl hover:bg-gradient-to-r hover:from-primary/10 hover:to-secondary/10 transition-all duration-200 border border-transparent hover:border-primary/20">
                        @if ($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                class="h-8 w-8 mr-2 rounded-lg object-cover group-hover/item:scale-110 transition-transform duration-200">
                        @else
                            <div
                                class="h-8 w-8 mr-2 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center group-hover/item:scale-110 transition-transform duration-200">
                                <span
                                    class="text-primary-content text-xs font-bold">{{ substr($category->name, 0, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4
                                class="font-medium text-xs text-base-content group-hover/item:text-primary transition-colors duration-200 truncate">
                                {{ $category->name }}
                            </h4>
                            @if ($category->description)
                                <p class="text-xs text-base-content/60 truncate">{{ $category->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            @if (count($categories) > 12)
                <div class="mt-4 pt-3 border-t border-base-300 text-center">
                    <a wire:navigate href="{{ route('categories') }}"
                        class="inline-flex items-center px-3 py-1 bg-primary text-primary-content rounded-lg hover:bg-primary-focus transition-colors duration-200 text-sm">
                        View All {{ count($categories) }} Categories
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-6">
                <div class="h-12 w-12 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-base-content/40" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-base-content/60">No categories available</p>
            </div>
        @endif
    </div>
</div>
