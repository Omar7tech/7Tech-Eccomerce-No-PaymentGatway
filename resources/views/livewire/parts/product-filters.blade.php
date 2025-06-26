<div>
    <!-- Enhanced Filter Component -->
    <div class="bg-base-100 rounded-2xl shadow-xl border border-base-300/50 overflow-hidden">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-primary/10 via-secondary/10 to-accent/10 p-6 border-b border-base-300/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-base-content">Smart Filters</h2>
                        <p class="text-sm text-base-content/60">Find exactly what you're looking for</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    @if (collect([$search, $category, !empty($selectedTags)])->filter()->count() > 0)
                        <div class="badge badge-primary badge-lg font-semibold animate-pulse">
                            {{ collect([$search, $category, !empty($selectedTags)])->filter()->count() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Active Filters with improved design -->
            @if ($search || $category || !empty($selectedTags))
                <div class="alert shadow-sm border-l-4 border-l-info animate-slideDown">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-semibold text-info-content">Active Filters</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @if ($search)
                                <div class="badge badge-info gap-2 p-3 transition-all hover:scale-105">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    {{ Str::limit($search, 20) }}
                                </div>
                            @endif
                            @if ($category)
                                <div class="badge badge-secondary gap-2 p-3 transition-all hover:scale-105">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                    Category
                                </div>
                            @endif
                            @if (!empty($selectedTags))
                                <div class="badge badge-accent gap-2 p-3 transition-all hover:scale-105">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    {{ count($selectedTags) }} Tag{{ count($selectedTags) > 1 ? 's' : '' }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <button wire:click="resetFilters"
                        class="btn btn-ghost btn-sm hover:btn-error transition-all duration-300 hover:scale-110">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Enhanced Search Section -->
            <div class="form-control space-y-3">
                <label class="label pb-0">
                    <span class="label-text font-bold text-lg text-base-content flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        Search Products
                    </span>
                </label>

                <div class="relative group">
                    <input type="text" wire:model.live.debounce.500ms="search"
                        placeholder="What are you looking for today?"
                        class="input input-bordered input-lg w-full pr-12 pl-12 transition-all duration-300 focus:input-primary focus:shadow-lg focus:scale-[1.02] group-hover:shadow-md">

                    <!-- Search Icon -->
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-base-content/40 group-focus-within:text-primary transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <!-- Clear Button -->
                    @if ($search)
                        <button wire:click="$set('search', '')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-base-content/40 hover:text-error transition-all duration-200 hover:scale-110">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @endif
                </div>

                @if ($search)
                    <div class="flex items-center gap-2 text-sm text-primary animate-fadeIn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Searching for: <strong>"{{ $search }}"</strong></span>
                    </div>
                @endif
            </div>

            <div class="divider opacity-30"></div>

            <!-- Enhanced Categories Section -->
            <div class="form-control space-y-4">
                <div class="flex items-center justify-between">
                    <label class="label pb-0">
                        <span class="label-text font-bold text-lg text-base-content flex items-center gap-3">
                            <div class="w-8 h-8 bg-secondary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            Categories
                        </span>
                    </label>
                    @if ($category)
                        <button wire:click="$set('category', '')"
                            class="btn btn-ghost btn-xs text-error hover:btn-error hover:text-error-content transition-all duration-200">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear
                        </button>
                    @endif
                </div>

                <div
                    class="bg-base-50 rounded-xl p-4 border border-base-200 space-y-2 max-h-72 overflow-y-auto custom-scrollbar">
                    <!-- All Categories Option -->
                    <button wire:click="$set('category', '')"
                        class="btn {{ empty($category) ? 'btn-primary' : 'btn-ghost hover:btn-outline hover:btn-primary' }}
                               btn-sm w-full justify-start gap-3 transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-6 h-6 rounded-lg {{ empty($category) ? 'bg-primary-content' : 'bg-base-300' }}
                                        flex items-center justify-center transition-all duration-200">
                                <svg class="w-4 h-4 {{ empty($category) ? 'text-primary' : 'text-base-content/60' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium">All Categories</span>
                        </div>
                        @if (empty($category))
                            <div class="ml-auto">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        @endif
                    </button>

                    <!-- Category List -->
                    @foreach ($categories as $cat)
                        <button wire:key="cat-{{ $cat->slug }}"
                            wire:click="$set('category', '{{ $cat->slug }}')"
                            class="btn {{ $category === $cat->slug ? 'btn-accent' : 'btn-ghost hover:btn-outline hover:btn-accent' }}
                                   btn-sm w-full justify-start gap-3 transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-3 h-3 rounded-full {{ $category === $cat->slug ? 'bg-accent' : 'bg-base-300' }}
                                            transition-all duration-200 {{ $category === $cat->slug ? 'shadow-lg shadow-accent/30' : '' }}">
                                </div>
                                <span class="font-medium">{{ $cat->name }}</span>
                            </div>
                            @if ($category === $cat->slug)
                                <div class="ml-auto">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="divider opacity-30"></div>

            <!-- Enhanced Tags Section -->
            @if ($tags && $tags->count() > 0)
                <div class="form-control space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="label pb-0">
                            <span class="label-text font-bold text-lg text-base-content flex items-center gap-3">
                                <div class="w-8 h-8 bg-accent/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                </div>
                                Tags
                                @if (!empty($selectedTags))
                                    <span
                                        class="badge badge-accent badge-sm font-bold">{{ count($selectedTags) }}</span>
                                @endif
                            </span>
                        </label>
                        @if (!empty($selectedTags))
                            <button wire:click="$set('selectedTags', [])"
                                class="btn btn-ghost btn-xs text-error hover:btn-error hover:text-error-content transition-all duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Clear All
                            </button>
                        @endif
                    </div>

                    <div
                        class="bg-gradient-to-br from-base-50 to-base-100 rounded-xl p-3 border border-base-200 min-h-[3rem]">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($tags as $tag)
                                @if ($tag->products_count > 0)
                                    <button wire:click="toggleTag({{ $tag->id }})"
                                        class="btn btn-xs gap-1 transition-all duration-200 hover:scale-105
                                               {{ in_array($tag->id, $selectedTags ?? []) ? 'btn-accent' : 'btn-outline hover:btn-accent' }}">
                                        <span class="text-xs font-medium">{{ $tag->name }}</span>
                                        <span
                                            class="badge badge-xs {{ in_array($tag->id, $selectedTags ?? []) ? 'badge-accent-content' : 'badge-ghost' }}
                                                     font-bold">
                                            {{ $tag->products_count }}
                                        </span>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @if (!empty($selectedTags))
                        <div class="flex items-center gap-2 text-sm text-accent animate-fadeIn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span><strong>{{ count($selectedTags) }}</strong>
                                tag{{ count($selectedTags) > 1 ? 's' : '' }} selected</span>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Enhanced Action Section -->
            <div class="pt-4 border-t border-base-200">
                <button wire:click="resetFilters"
                    class="btn btn-outline btn-error w-full gap-3 hover:btn-error transition-all duration-300 hover:scale-[1.02] hover:shadow-lg group
                           {{ !$search && !$category && empty($selectedTags) ? 'btn-disabled opacity-50' : '' }}"
                    @if (!$search && !$category && empty($selectedTags)) disabled @endif>
                    <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    <span class="font-semibold">Reset All Filters</span>
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Custom animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-slideDown {
            animation: slideDown 0.3s ease-out;
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: hsl(var(--b2));
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: hsl(var(--bc) / 0.2);
            border-radius: 4px;
            transition: background 0.2s;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: hsl(var(--bc) / 0.3);
        }

        /* Enhanced button animations */
        .btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn:not(.btn-disabled):hover {
            transform: translateY(-2px);
        }

        /* Focus styles */
        .input:focus {
            box-shadow: 0 0 0 4px rgba(var(--p) / 0.2);
            border-color: hsl(var(--p));
        }

        /* Improved badge animations */
        .badge {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Group hover effects */
        .group:hover .group-hover\:shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</div>
