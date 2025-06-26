@props(['content' => [], 'categories' => [], 'settings' => [], 'aboutPageSettings' => []])



{{-- Mobile Full Page Navigation --}}
<div id="mobile-nav-drawer"
    class="fixed inset-0 bg-base-100 z-50 transform translate-x-full lg:hidden transition-transform duration-300 ease-in-out">
    <div class="p-4 h-full overflow-y-auto">
        {{-- Sidebar Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                    alt="Logo" class="h-8 w-auto mr-2">
                <span class="text-lg font-semibold">Menu</span>
            </div>
            <button id="close-mobile-nav" class="btn btn-ghost btn-sm btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Sidebar Navigation --}}
        <nav class="space-y-2">
            <a wire:navigate href="{{ route('home') }}"
                class="flex items-center py-3 px-4 rounded-lg text-sm font-medium
               {{ Route::is('home') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content' : 'hover:bg-base-200 hover:text-primary' }}
               transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
            </a>

            {{-- Mobile Categories with Accordion --}}
            <div class="collapse collapse-arrow bg-base-200 rounded-lg">
                <input type="checkbox" class="peer" id="mobile-categories-toggle">
                <div
                    class="collapse-title flex items-center py-3 px-4 text-sm font-medium cursor-pointer
                     {{ Route::is('categories') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content' : 'hover:text-primary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Categories
                </div>
                <div class="collapse-content px-0">
                    <div class="pl-4 pr-2 pb-2">
                        <a wire:navigate href="{{ route('categories') }}"
                            class="flex items-center py-2 px-4 rounded-lg text-sm font-medium text-primary hover:bg-base-300 transition-all duration-200 mb-2">
                            View All Categories
                        </a>
                        @if (count($categories) > 0)
                            <div class="space-y-1">
                                @foreach ($categories->take(10) as $category)
                                    <a href="{{ route('products', ['category' => $category->slug]) }}"
                                        class="flex items-center py-2 px-4 rounded-lg text-sm hover:bg-base-300 transition-all duration-200">
                                        @if ($category->image)
                                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                                class="h-4 w-4 mr-3 rounded object-cover">
                                        @else
                                            <div
                                                class="h-4 w-4 mr-3 bg-gradient-to-br from-primary to-secondary rounded">
                                            </div>
                                        @endif
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                                @if (count($categories) > 10)
                                    <a wire:navigate href="{{ route('categories') }}"
                                        class="flex items-center py-2 px-4 rounded-lg text-xs text-primary hover:bg-base-300 transition-all duration-200">
                                        + {{ count($categories) - 8 }} more categories
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <a wire:navigate href="{{ route('products') }}"
                class="flex items-center py-3 px-4 rounded-lg text-sm font-medium
               {{ Route::is('products') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content' : 'hover:bg-base-200 hover:text-primary' }}
               transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                All Products
            </a>

            @if ($aboutPageSettings->active)
                <a wire:navigate href="{{ route('about') }}"
                    class="flex items-center py-3 px-4 rounded-lg text-sm font-medium
               {{ Route::is('about') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content' : 'hover:bg-base-200 hover:text-primary' }}
               transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    About
                </a>
            @endif

        </nav>

        {{-- Sidebar Footer (Auth Section) --}}
        <div class="mt-8 pt-4 border-t border-base-300">
            <!-- No auth logic, nothing here -->
        </div>
    </div>
</div>

{{-- Main Navbar --}}
<div class="navbar bg-base-100 sticky top-0 z-30 shadow-md animate__animated animate__fadeIn py-2 lg:py-1">
    <div class="navbar-start">
        {{-- Mobile Drawer Toggle (visible on smaller screens) --}}
        <div class="lg:hidden">
            <button id="open-mobile-nav" class="btn btn-ghost focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </button>
        </div>
        {{-- Site Logo --}}
        <a wire:navigate href="{{ route('home') }}"
            class="btn btn-ghost normal-case hover:scale-105 transition-transform duration-300 px-2 lg:px-0">
            <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                alt="Logo" class="h-8 lg:h-9 w-auto">
        </a>
    </div>

    {{-- Desktop Navigation Menu (hidden on smaller screens) --}}
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal p-0 space-x-1">
            <li>
                <a wire:navigate href="{{ route('home') }}"
                    class="py-1.5 px-3 rounded-md text-sm
                   {{ Route::is('home') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content font-semibold' : 'hover:bg-base-200 hover:text-primary' }}
                   transition-all duration-200 ease-in-out">
                    Home
                </a>
            </li>

            {{-- Categories Mega Menu --}}
            <li class="relative group">
                <a href="#"
                    class="py-1.5 px-3 rounded-md text-sm flex items-center
                   {{ Route::is('categories') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content font-semibold' : 'hover:bg-base-200 hover:text-primary' }}
                   transition-all duration-200 ease-in-out">
                    Categories
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 ml-1 transition-transform duration-200 group-hover:rotate-180" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                    class="py-1.5 px-3 rounded-md text-sm
                   {{ Route::is('products') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content font-semibold' : 'hover:bg-base-200 hover:text-primary' }}
                   transition-all duration-200 ease-in-out">
                    All Products
                </a>
            </li>
            @if ($aboutPageSettings->active)
                <li>
                    <a wire:navigate href="{{ route('about') }}"
                        class="py-1.5 px-3 rounded-md text-sm
                   {{ Route::is('about') ? 'bg-gradient-to-r from-primary to-secondary text-primary-content font-semibold' : 'hover:bg-base-200 hover:text-primary' }}
                   transition-all duration-200 ease-in-out">
                        About
                    </a>
                </li>
            @endif
        </ul>
    </div>

    {{-- Navbar End: Cart and Auth Buttons --}}
    <div class="navbar-end gap-2 lg:gap-1">
        <x-cart-drawer />
    </div>
</div>

{{-- JavaScript for Mobile Navigation and Mega Menu --}}
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

            if (newOpenBtn && !newOpenBtn.hasAttribute('data-initialized')) {
                newOpenBtn.setAttribute('data-initialized', 'true');
                newOpenBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (newDrawer) {
                        newDrawer.classList.remove('translate-x-full');
                        document.body.style.overflow = 'hidden';
                    }
                });
            }

            if (newCloseBtn && !newCloseBtn.hasAttribute('data-initialized')) {
                newCloseBtn.setAttribute('data-initialized', 'true');
                newCloseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (newDrawer) {
                        newDrawer.classList.add('translate-x-full');
                        document.body.style.overflow = '';
                    }
                });
            }
        });
    });

    // Alternative approach using direct event delegation
    document.addEventListener('click', function(e) {
        // Handle mobile menu open button
        if (e.target.closest('#open-mobile-nav')) {
            e.preventDefault();
            const drawer = document.getElementById('mobile-nav-drawer');
            if (drawer) {
                drawer.classList.remove('translate-x-full');
                document.body.style.overflow = 'hidden';
            }
        }

        // Handle mobile menu close button
        if (e.target.closest('#close-mobile-nav')) {
            e.preventDefault();
            const drawer = document.getElementById('mobile-nav-drawer');
            if (drawer) {
                drawer.classList.add('translate-x-full');
                document.body.style.overflow = '';
            }
        }
    });
</script>
