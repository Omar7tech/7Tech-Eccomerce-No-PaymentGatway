@props(['categories' => []])
<div class="py-16">
    <section class="container mx-auto px-4 relative z-10">
        <!-- Animated header with gradient text -->
        <div class="text-center mb-16">
            <span class="inline-block text-sm font-semibold text-primary mb-3 tracking-widest">EXPLORE COLLECTIONS</span>
            <h2
                class="text-4xl md:text-6xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary p-5">
                Shop by Category
            </h2>
        </div>

        <!-- Search Bar -->
        <div class="mb-12 max-w-md mx-auto relative">
            <div class="relative">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search categories..."
                    class="w-full pl-12 pr-4 py-3 rounded-full border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/50 transition-all duration-300 shadow-sm">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button wire:click="$set('search', '')"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                    x-show="$wire.search.length > 0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Categories Grid -->
        @if ($categories->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No categories found matching your search.</p>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($categories as $index => $category)
                    <div class="relative group" x-data="{ hover: false }" @mouseenter="hover = true"
                        @mouseleave="hover = false">
                        <!-- Floating card with 3D effect -->
                        <div class="relative h-full transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                            :style="hover ? 'transform: perspective(1000px) rotateY(10deg) rotateX(-5deg) translateZ(20px)' :
                                'transform: perspective(1000px) rotateY(0) rotateX(0) translateZ(0)'">
                            @if ($content->category_mode == 1)
                                <div>
                                    <x-categories.card :category="$category" :floating="true" :$content />
                                </div>
                            @endif
                            @if ($content->category_mode == 2)
                                <div class="">
                                    <x-categories.card2 :category="$category" :floating="true" :$content />
                                </div>
                            @endif
                            @if ($content->category_mode == 3)
                                <div class="">
                                    <x-categories.card3 :category="$category" :floating="true" :$content />
                                </div>
                            @endif
                            @if ($content->category_mode == 4)
                                <div class="">
                                    <x-categories.card4 :category="$category" :floating="true" :$content />
                                </div>
                            @endif
                        </div>

                        <!-- Floating shadow -->
                        <div class="absolute inset-0 rounded-2xl bg-black/10 blur-md scale-95 -z-10 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                            :style="hover ? 'transform: translateY(15px) scale(0.95)' : 'transform: translateY(0) scale(0.95)'">
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- View All Button (hidden when searching) -->
        @if (empty($search))
            <div class="text-center mt-20">
                <button wire:click="toggleShowAll"
                    class="btn btn-neutral relative px-8 py-4 text-lg font-bold rounded-full transition-all duration-300 ease-in-out group">
                    <span class="flex items-center space-x-2" wire:loading.remove>
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-90"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <span>
                            {{ $showAll ? 'Show Less' : 'View All Categories' }}
                        </span>
                    </span>
                    <span class="loading loading-dots loading-md" wire:loading></span>
                </button>
            </div>
        @endif
    </section>
</div>
