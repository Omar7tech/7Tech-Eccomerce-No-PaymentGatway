@props(['content' => [], 'categories' => [], 'settings' => [], 'aboutPageSettings' => []])

{{-- Mobile Full Page Navigation --}}
<div id="mobile-nav-drawer"
    class="fixed inset-0 bg-base-100/95 backdrop-blur-md z-50 transform translate-x-full lg:hidden transition-transform duration-500 ease-out">
    <div class="p-6 h-full overflow-y-auto">
        {{-- Sidebar Header --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
                <div class="avatar">
                    <div class="w-10 rounded-xl">
                        <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                            alt="Logo" class="object-cover">
                    </div>
                </div>
                <div>
                    <h2
                        class="text-xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        Navigation
                    </h2>
                    <p class="text-xs text-base-content/60">Explore our platform</p>
                </div>
            </div>
            <button id="close-mobile-nav"
                class="btn btn-ghost btn-sm btn-square hover:btn-error hover:rotate-90 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Sidebar Navigation --}}
        <nav class="space-y-3">
            <a wire:navigate href="{{ route('home') }}"
                class="group flex items-center py-4 px-5 rounded-2xl text-sm font-medium relative overflow-hidden
                {{ Route::is('home') ? 'bg-gradient-to-r from-primary/20 to-secondary/20 border border-primary/30 text-primary shadow-lg' : 'hover:bg-base-200/70 hover:text-primary border border-transparent' }}
                transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center space-x-4 relative z-10">
                    <div
                        class="p-2 rounded-xl {{ Route::is('home') ? 'bg-primary/20' : 'bg-base-200 group-hover:bg-primary/10' }} transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <span class="font-semibold">Home</span>
                </div>
                @if (Route::is('home'))
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                    </div>
                @endif
            </a>

            {{-- Mobile Categories with Enhanced Accordion --}}
            <div class="card bg-base-200/50 border border-base-300/50 rounded-2xl overflow-hidden">
                <div class="collapse collapse-arrow">
                    <input type="checkbox" class="peer" id="mobile-categories-toggle">
                    <div class="collapse-title p-0">
                        <div
                            class="group flex items-center py-4 px-5 text-sm font-medium cursor-pointer
                                {{ Route::is('categories') ? 'bg-gradient-to-r from-primary/20 to-secondary/20 text-primary' : 'hover:bg-base-200/70 hover:text-primary' }}
                                transition-all duration-300">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="p-2 rounded-xl {{ Route::is('categories') ? 'bg-primary/20' : 'bg-base-200 group-hover:bg-primary/10' }} transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <span class="font-semibold">Categories</span>
                            </div>
                        </div>
                    </div>
                    <div class="collapse-content px-0 pb-0">
                        <div class="px-5 pb-4 space-y-2">
                            <a wire:navigate href="{{ route('categories') }}"
                                class="flex items-center py-3 px-4 rounded-xl text-sm font-medium text-primary hover:bg-primary/10 border border-primary/20 hover:border-primary/40 transition-all duration-200 group">
                                <div
                                    class="p-1.5 rounded-lg bg-primary/10 mr-3 group-hover:bg-primary/20 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                View All Categories
                            </a>
                            @if (count($categories) > 0)
                                <div class="space-y-1.5">
                                    @foreach ($categories->take(10) as $category)
                                        <a href="{{ route('products', ['category' => $category->slug]) }}"
                                            class="flex items-center py-2.5 px-4 rounded-xl text-sm hover:bg-base-300/50 hover:text-primary transition-all duration-200 group border border-transparent hover:border-base-300">
                                            @if ($category->image)
                                                <div class="avatar mr-3">
                                                    <div class="w-6 h-6 rounded-lg">
                                                        <img src="{{ Storage::url($category->image) }}"
                                                            alt="{{ $category->name }}" class="object-cover">
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    class="w-6 h-6 mr-3 bg-gradient-to-br from-primary to-secondary rounded-lg opacity-80 group-hover:opacity-100 transition-opacity duration-200">
                                                </div>
                                            @endif
                                            <span class="font-medium">{{ $category->name }}</span>
                                        </a>
                                    @endforeach
                                    @if (count($categories) > 10)
                                        <a wire:navigate href="{{ route('categories') }}"
                                            class="flex items-center py-2.5 px-4 rounded-xl text-xs font-semibold text-primary hover:bg-primary/10 transition-all duration-200 border border-dashed border-primary/30 hover:border-primary/60">
                                            <div
                                                class="w-6 h-6 mr-3 rounded-lg bg-primary/10 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </div>
                                            + {{ count($categories) - 10 }} more categories
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <a wire:navigate href="{{ route('products') }}"
                class="group flex items-center py-4 px-5 rounded-2xl text-sm font-medium relative overflow-hidden
                {{ Route::is('products') ? 'bg-gradient-to-r from-primary/20 to-secondary/20 border border-primary/30 text-primary shadow-lg' : 'hover:bg-base-200/70 hover:text-primary border border-transparent' }}
                transition-all duration-300 transform hover:scale-[1.02]">
                <div class="flex items-center space-x-4 relative z-10">
                    <div
                        class="p-2 rounded-xl {{ Route::is('products') ? 'bg-primary/20' : 'bg-base-200 group-hover:bg-primary/10' }} transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="font-semibold">All Products</span>
                </div>
                @if (Route::is('products'))
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                    </div>
                @endif
            </a>

            @if ($aboutPageSettings->active)
                <a wire:navigate href="{{ route('about') }}"
                    class="group flex items-center py-4 px-5 rounded-2xl text-sm font-medium relative overflow-hidden
                    {{ Route::is('about') ? 'bg-gradient-to-r from-primary/20 to-secondary/20 border border-primary/30 text-primary shadow-lg' : 'hover:bg-base-200/70 hover:text-primary border border-transparent' }}
                    transition-all duration-300 transform hover:scale-[1.02]">
                    <div class="flex items-center space-x-4 relative z-10">
                        <div
                            class="p-2 rounded-xl {{ Route::is('about') ? 'bg-primary/20' : 'bg-base-200 group-hover:bg-primary/10' }} transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-semibold">About</span>
                    </div>
                    @if (Route::is('about'))
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                            <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                        </div>
                    @endif
                </a>
            @endif
        </nav>

        {{-- Sidebar Footer (Auth Section) --}}
        <div class="mt-10 pt-6 border-t border-base-300/50">
            <!-- No auth logic, nothing here -->
        </div>
    </div>
</div>

{{-- Main Navbar --}}
<div class="navbar bg-base-100 sticky top-0 z-30 border-b border-base-300/50 py-3 lg:py-2">

    <div class="navbar-start">
        {{-- Mobile Drawer Toggle --}}
        <div class="lg:hidden">
            <button id="open-mobile-nav"
                class="btn btn-ghost btn-square hover:bg-primary/10 hover:text-primary transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </button>
        </div>
        {{-- Site Logo --}}
        <a wire:navigate href="{{ route('home') }}"
            class="btn btn-ghost normal-case hover:bg-primary/10 transition-all duration-300 px-3 lg:px-2 group">
            <div class="flex items-center space-x-3">
                <div class="avatar">
                    <div class="w-8 lg:w-10 rounded-xl group-hover:scale-110 transition-transform duration-300">
                        <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                            alt="Logo" class="object-cover">
                    </div>
                </div>
                <div class="hidden sm:block">
                    <h1
                        class="text-lg font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        {{ $settings->site_name ?? 'Brand' }}
                    </h1>
                </div>
            </div>
        </a>
    </div>

    {{-- Desktop Navigation Menu --}}
    <div class="navbar-center hidden lg:flex">
        <div class="bg-base-200/50 rounded-2xl p-2  border border-base-300/50">
            <ul class="menu menu-horizontal p-0 space-x-2">
                <li>
                    <a wire:navigate href="{{ route('home') }}"
                        class="py-2.5 px-4 rounded-xl text-sm font-medium transition-all duration-300
                        {{ Route::is('home') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content shadow-lg scale-105' : 'hover:bg-base-100 hover:text-primary hover:scale-105' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>
                </li>

                {{-- Categories Mega Menu --}}
                <li class="relative group">
                    <a href="#"
                        class="py-2.5 px-4 rounded-xl text-sm font-medium flex items-center transition-all duration-300
                        {{ Route::is('categories') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content shadow-lg scale-105' : 'hover:bg-base-100 hover:text-primary hover:scale-105' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Categories
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 ml-2 transition-transform duration-300 group-hover:rotate-180"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    @if ($content->nav_category_menu_mode == 1)
                        <x-Nav.megaMenu1 :categories="$categories" />
                    @elseif ($content->nav_category_menu_mode == 2)
                        <x-Nav.megaMenu2 :categories="$categories" />
                    @elseif ($content->nav_category_menu_mode == 3)
                        <x-Nav.megaMenu3 :categories="$categories" />
                    @elseif ($content->nav_category_menu_mode == 4)
                        <x-Nav.megaMenu4 :categories="$categories" />
                    @else
                        <x-Nav.megaMenu1 :categories="$categories" />
                    @endif
                </li>

                <li>
                    <a wire:navigate href="{{ route('products') }}"
                        class="py-2.5 px-4 rounded-xl text-sm font-medium transition-all duration-300
                        {{ Route::is('products') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content shadow-lg scale-105' : 'hover:bg-base-100 hover:text-primary hover:scale-105' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Products
                    </a>
                </li>

                @if ($aboutPageSettings->active)
                    <li>
                        <a wire:navigate href="{{ route('about') }}"
                            class="py-2.5 px-4 rounded-xl text-sm font-medium transition-all duration-300
                            {{ Route::is('about') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content shadow-lg scale-105' : 'hover:bg-base-100 hover:text-primary hover:scale-105' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            About
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    {{-- Navbar End: Cart and Auth Buttons --}}
    <div class="navbar-end gap-3 lg:gap-2">
        <x-cart-drawer />
    </div>


    <script>
        document.addEventListener('livewire:navigated', function() {
            const drawer = document.getElementById('mobile-nav-drawer');
            const openBtn = document.getElementById('open-mobile-nav');
            const closeBtn = document.getElementById('close-mobile-nav');

            function openDrawer() {
                if (drawer) {
                    drawer.classList.remove('translate-x-full');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeDrawer() {
                if (drawer) {
                    drawer.classList.add('translate-x-full');
                    document.body.style.overflow = '';
                }
            }

            // Add event listeners with proper error handling
            if (openBtn) {
                openBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    openDrawer();
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeDrawer();
                });
            }

            // Close drawer when clicking on navigation links (mobile)
            if (drawer) {
                const mobileNavLinks = drawer.querySelectorAll('a[wire\\:navigate]');
                mobileNavLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        // Small delay to allow navigation to process
                        setTimeout(closeDrawer, 100);
                    });
                });

                // Close drawer when clicking outside
                drawer.addEventListener('click', function(e) {
                    if (e.target === drawer) {
                        closeDrawer();
                    }
                });
            }

            // Handle escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && drawer && !drawer.classList.contains('translate-x-full')) {
                    closeDrawer();
                }
            });

            // Handle Livewire navigation
            document.addEventListener('livewire:navigated', function() {
                // Reinitialize after Livewire navigation
                const newDrawer = document.getElementById('mobile-nav-drawer');
                const newOpenBtn = document.getElementById('open-mobile-nav');
                const newCloseBtn = document.getElementById('close-mobile-nav');

                if (newOpenBtn && !newOpenBtn.hasAttribute('data-listener-added')) {
                    newOpenBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        openDrawer();
                    });
                    newOpenBtn.setAttribute('data-listener-added', 'true');
                }

                if (newCloseBtn && !newCloseBtn.hasAttribute('data-listener-added')) {
                    newCloseBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        closeDrawer();
                    });
                    newCloseBtn.setAttribute('data-listener-added', 'true');
                }
            });
        });
    </script>

</div>
