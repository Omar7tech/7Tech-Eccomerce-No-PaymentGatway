@props(['footer' , 'settings'])

@if ($footer->footer_enabled)
    <footer class="relative overflow-hidden bg-base-200">

        <!-- Main Footer Content -->
        <div class="relative">
            <!-- Top Section with Company Info -->
            <div class="bg-base-300">
                <div class="container mx-auto px-6 py-12 max-w-7xl">
                    <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                        <!-- Logo and Company Info -->
                        <div class="flex flex-col lg:flex-row items-center gap-6">
                            <div class="avatar">
                                <div class="w-16 rounded-full ring ring-primary ring-offset-base-300 ring-offset-2">
                                    <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                                         alt="{{ $settings->site_name }}" />
                                </div>
                            </div>
                            <div class="text-center lg:text-left">
                                <h1 class="text-3xl font-bold text-primary mb-2">{{ $settings->site_name }}</h1>
                                @if ($footer->footer_text)
                                    <div class="max-w-md text-base-content/80 text-sm leading-relaxed">
                                        {!! Str::markdown($footer->footer_text) !!}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Social Links -->
                        @if (!empty($footer->footer_socials))
                            <div class="flex flex-col items-center gap-4">
                                <h3 class="text-lg font-semibold text-base-content">Connect With Us</h3>
                                <div class="flex gap-2">
                                    @foreach ($footer->footer_socials as $social)
                                        <div class="tooltip tooltip-bottom" data-tip="{{ $social['platform'] }}">
                                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                                class="btn btn-square btn-ghost hover:btn-primary hover:scale-110 transition-all duration-300">
                                                @if (isset($social['icon_url']))
                                                    <img src="{{ $social['icon_url'] }}" alt="{{ $social['platform'] }}"
                                                        class="w-5 h-5"
                                                        onerror="this.style.display='none'; this.parentNode.innerHTML='<div class=\'w-5 h-5 bg-primary rounded flex items-center justify-center text-xs font-bold text-primary-content\'>{{ substr($social['platform'], 0, 1) }}</div>'">
                                                @else
                                                    <div class="w-5 h-5 bg-primary rounded flex items-center justify-center text-xs font-bold text-primary-content">
                                                        {{ substr($social['platform'], 0, 1) }}
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cards Section -->
            <div class="container mx-auto px-6  max-w-7xl">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Quick Links Card -->
                    @if (!empty($footer->footer_links))
                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="card-body">
                                <h2 class="card-title text-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                        </path>
                                    </svg>
                                    Quick Links
                                </h2>
                                <div class="divider divider-primary mt-2 mb-4"></div>
                                <div class="space-y-2">
                                    @foreach ($footer->footer_links as $link)
                                        <a href="{{ $link['url'] }}"
                                           class="flex items-center gap-2 p-2 rounded-lg hover:bg-primary/10 hover:text-primary transition-all duration-200 group">
                                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            {{ $link['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Contact Info Card -->
                    @if (!empty($footer->footer_phones) || !empty($footer->footer_emails))
                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="card-body">
                                <h2 class="card-title text-secondary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    Get In Touch
                                </h2>
                                <div class="divider divider-secondary mt-2 mb-4"></div>
                                <div class="space-y-3">
                                    @if (!empty($footer->footer_phones))
                                        @foreach ($footer->footer_phones as $phone)
                                            <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-secondary/10 transition-colors">
                                                <div class="badge badge-secondary badge-sm">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <a href="tel:{{ $phone['number'] }}" class="text-sm hover:text-secondary transition-colors">
                                                    {{ $phone['number'] }}
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if (!empty($footer->footer_emails))
                                        @foreach ($footer->footer_emails as $email)
                                            <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-secondary/10 transition-colors">
                                                <div class="badge badge-secondary badge-sm">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <a href="mailto:{{ $email['address'] }}" class="text-sm hover:text-secondary transition-colors break-all">
                                                    {{ $email['address'] }}
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Locations Card -->
                    @if (!empty($footer->footer_locations))
                        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="card-body">
                                <h2 class="card-title text-accent">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Our Locations
                                </h2>
                                <div class="divider divider-accent mt-2 mb-4"></div>
                                <div class="space-y-3">
                                    @foreach ($footer->footer_locations as $location)
                                        <a href="{{ $location['url'] }}" target="_blank" rel="noopener noreferrer"
                                           class="block p-3 rounded-lg border border-accent/20 hover:border-accent hover:bg-accent/5 transition-all duration-200 group">
                                            <div class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-accent mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium group-hover:text-accent transition-colors">
                                                        {{ $location['name'] }}
                                                    </p>
                                                    <p class="text-xs text-base-content/60 group-hover:text-accent/70 transition-colors">
                                                        Click to view on map
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="bg-base-100">
                <div class="container mx-auto px-6 py-8 max-w-7xl">
                    <!-- Stats Section -->
                    <div class="stats stats-vertical lg:stats-horizontal shadow w-full mb-8 bg-base-200">
                        <div class="stat">
                            <div class="stat-figure text-primary">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="stat-title">Performance</div>
                            <div class="stat-value text-primary">Fast</div>
                            <div class="stat-desc">Optimized for speed</div>
                        </div>

                        <div class="stat">
                            <div class="stat-figure text-secondary">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="stat-title">Quality</div>
                            <div class="stat-value text-secondary">100%</div>
                            <div class="stat-desc">Satisfaction guaranteed</div>
                        </div>

                        <div class="stat">
                            <div class="stat-figure text-accent">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div class="stat-title">Support</div>
                            <div class="stat-value text-accent">24/7</div>
                            <div class="stat-desc">Always here for you</div>
                        </div>
                    </div>

                    <!-- Copyright and Links -->
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                        <div class="text-center lg:text-left">
                            <p class="text-base-content/70 text-sm">
                                &copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-4 text-sm">
                            <a href="#" class="link link-hover">Privacy Policy</a>
                            <a href="#" class="link link-hover">Terms of Service</a>
                            <a href="#" class="link link-hover">Cookie Policy</a>
                        </div>
                    </div>

                    <!-- Developer Credit -->
                    <div class="text-center mt-8 pt-6 border-t border-base-content/10">
                        <div class="flex flex-col items-center gap-3">
                            <p class="text-sm text-base-content/60">
                                Crafted with
                                <span class="text-error animate-pulse">❤️</span>
                                by
                                <span class="font-bold text-primary">Omar7Tech</span>
                            </p>
                            <div class="flex gap-4 text-xs">
                                <a href="mailto:omar.7tech@gmail.com"
                                   class="badge badge-outline badge-primary hover:badge-primary hover:text-primary-content transition-all">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Email
                                </a>
                                <a href="tel:+96171387946"
                                   class="badge badge-outline badge-secondary hover:badge-secondary hover:text-secondary-content transition-all">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    Call
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Top -->
                    <div class="text-center mt-6">
                        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                                class="btn btn-circle btn-primary btn-sm hover:btn-primary-focus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endif
