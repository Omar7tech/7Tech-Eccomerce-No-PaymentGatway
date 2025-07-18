@props(['content' => [], 'categories' => [], 'settings' => [], 'aboutPageSettings' => null])

<div class="navbar bg-base-100 sticky top-0 z-50 shadow-md animate__animated animate__fadeIn">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </label>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a wire:current.exact='text-primary' wire:navigate href="{{ route('home') }}">Home</a></li>
                <li><a wire:current='text-primary' wire:navigate href="{{ route('categories') }}">Categories</a></li>
                <li><a wire:current='text-primary' wire:navigate href="{{ route('products') }}">All Products</a></li>
                @if ($aboutPageSettings->active)
                    <li><a wire:current='text-primary' wire:navigate href="{{ route('about') }}">About</a></li>
                @endif
            </ul>
        </div>
        <a wire:navigate href="{{ route('home') }}"
            class="btn btn-ghost normal-case hover:scale-105 transition-transform">
            <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                alt="Logo" class="h-12 w-auto">
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a wire:current.exact='text-primary' wire:navigate href="{{ route('home') }}"
                    class="hover:text-primary transition-colors">Home</a></li>
            <li><a wire:current='text-primary' wire:navigate href="{{ route('categories') }}"
                    class="hover:text-primary transition-colors">Categories</a></li>
            <li><a wire:current='text-primary' wire:navigate href="{{ route('products') }}"
                    class="hover:text-primary transition-colors">All Products</a></li>
            @if ($aboutPageSettings->active)
                <li><a wire:current='text-primary' wire:navigate href="{{ route('about') }}"
                        class="hover:text-primary transition-colors">About</a></li>
            @endif
        </ul>
    </div>
    <div class="navbar-end gap-2">
        <x-cart-drawer />
    </div>
</div>
