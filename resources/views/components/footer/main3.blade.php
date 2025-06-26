@props(['footer' , 'settings'])

@if ($footer->footer_enabled)
    <footer class="bg-base-100 border-t border-base-300">
        <!-- Newsletter/CTA Section -->
        <div class="bg-gradient-to-r from-primary/5 via-secondary/5 to-accent/5">
            <div class="container mx-auto px-6 py-12 max-w-6xl">
                <div class="text-center space-y-6">
                    <div class="flex justify-center">
                        <div class="mask mask-hexagon w-20 h-20 bg-primary/10 flex items-center justify-center">
                            <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                                 alt="{{ $settings->site_name }}" class="w-10 h-10 object-contain" />
                        </div>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-base-content mb-3">{{ $settings->site_name }}</h2>
                        @if ($footer->footer_text)
                            <div class="prose prose-sm mx-auto max-w-2xl text-base-content/70">
                                {!! Str::markdown($footer->footer_text) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-6 py-16 max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                <!-- Links Column -->
                @if (!empty($footer->footer_links))
                    <div class="space-y-4">
                        <h3 class="font-semibold text-base-content text-sm uppercase tracking-wider mb-6 relative">
                            Navigation
                            <div class="absolute -bottom-2 left-0 w-8 h-0.5 bg-primary rounded-full"></div>
                        </h3>
                        <nav class="space-y-3">
                            @foreach ($footer->footer_links as $index => $link)
                                <a href="{{ $link['url'] }}"
                                   class="block text-base-content/70 hover:text-primary text-sm transition-all duration-200 hover:translate-x-1 relative group">
                                    <span class="relative z-10">{{ $link['label'] }}</span>
                                    <div class="absolute inset-0 -left-2 bg-primary/5 rounded-md scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-200"></div>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                @endif

                <!-- Contact Column -->
                @if (!empty($footer->footer_phones) || !empty($footer->footer_emails))
                    <div class="space-y-4">
                        <h3 class="font-semibold text-base-content text-sm uppercase tracking-wider mb-6 relative">
                            Contact
                            <div class="absolute -bottom-2 left-0 w-8 h-0.5 bg-secondary rounded-full"></div>
                        </h3>
                        <div class="space-y-4">
                            @if (!empty($footer->footer_phones))
                                @foreach ($footer->footer_phones as $phone)
                                    <div class="flex items-center gap-3 group">
                                        <div class="w-8 h-8 rounded-full bg-secondary/10 flex items-center justify-center group-hover:bg-secondary/20 transition-colors">
                                            <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <a href="tel:{{ $phone['number'] }}" class="text-sm text-base-content/70 hover:text-secondary transition-colors">
                                            {{ $phone['number'] }}
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                            @if (!empty($footer->footer_emails))
                                @foreach ($footer->footer_emails as $email)
                                    <div class="flex items-center gap-3 group">
                                        <div class="w-8 h-8 rounded-full bg-secondary/10 flex items-center justify-center group-hover:bg-secondary/20 transition-colors">
                                            <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <a href="mailto:{{ $email['address'] }}" class="text-sm text-base-content/70 hover:text-secondary transition-colors break-all">
                                            {{ $email['address'] }}
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Locations Column -->
                @if (!empty($footer->footer_locations))
                    <div class="space-y-4">
                        <h3 class="font-semibold text-base-content text-sm uppercase tracking-wider mb-6 relative">
                            Locations
                            <div class="absolute -bottom-2 left-0 w-8 h-0.5 bg-accent rounded-full"></div>
                        </h3>
                        <div class="space-y-3">
                            @foreach ($footer->footer_locations as $location)
                                <a href="{{ $location['url'] }}" target="_blank" rel="noopener noreferrer"
                                   class="block group">
                                    <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-accent/5 transition-all duration-200">
                                        <div class="w-6 h-6 rounded-full bg-accent/10 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-accent/20 transition-colors">
                                            <svg class="w-3 h-3 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-base-content group-hover:text-accent transition-colors">
                                                {{ $location['name'] }}
                                            </p>
                                            <p class="text-xs text-base-content/50 group-hover:text-accent/70 transition-colors">
                                                View on map →
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Social & Connect Column -->
                @if (!empty($footer->footer_socials))
                    <div class="space-y-4">
                        <h3 class="font-semibold text-base-content text-sm uppercase tracking-wider mb-6 relative">
                            Follow Us
                            <div class="absolute -bottom-2 left-0 w-8 h-0.5 bg-primary rounded-full"></div>
                        </h3>
                        <div class="space-y-4">
                            @foreach ($footer->footer_socials as $social)
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center gap-3 group">
                                    <div class="w-10 h-10 rounded-full bg-base-200 flex items-center justify-center group-hover:bg-primary group-hover:text-primary-content transition-all duration-200 group-hover:scale-110">
                                        @if (isset($social['icon_url']))
                                            <img src="{{ $social['icon_url'] }}" alt="{{ $social['platform'] }}"
                                                class="w-5 h-5 group-hover:invert transition-all"
                                                onerror="this.style.display='none'; this.parentNode.innerHTML='<span class=\'text-sm font-bold\'>{{ substr($social['platform'], 0, 1) }}</span>'">
                                        @else
                                            <span class="text-sm font-bold">{{ substr($social['platform'], 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <span class="text-sm text-base-content/70 group-hover:text-primary transition-colors">
                                        {{ $social['platform'] }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Minimal Bottom Bar -->
        <div class="border-t border-base-200">
            <div class="container mx-auto px-6 py-6 max-w-6xl">
                <div class="flex flex-col lg:flex-row justify-between items-center gap-4 text-sm">
                    <!-- Copyright -->
                    <div class="flex items-center gap-2 text-base-content/60">
                        <span>&copy; {{ date('Y') }} {{ $settings->site_name }}</span>
                        <div class="w-1 h-1 bg-base-content/30 rounded-full"></div>
                        <span>All rights reserved</span>
                    </div>

                    <!-- Legal Links -->
                    <div class="flex items-center gap-6 text-base-content/50">
                        <a href="#" class="hover:text-base-content transition-colors">Privacy</a>
                        <a href="#" class="hover:text-base-content transition-colors">Terms</a>
                        <a href="#" class="hover:text-base-content transition-colors">Cookies</a>
                    </div>
                </div>

                <!-- Developer Credit - Ultra Minimal -->
                <div class="text-center mt-6 pt-4 border-t border-base-200/50">
                    <div class="inline-flex items-center gap-2 text-xs text-base-content/40">
                        <span>Made by</span>
                        <div class="dropdown dropdown-top">
                            <div tabindex="0" role="button" class="font-semibold text-primary hover:text-primary-focus cursor-pointer">
                                Omar7Tech
                            </div>
                            <div tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-52 border border-base-300">
                                <li>
                                    <a href="mailto:omar.7tech@gmail.com" class="text-xs">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        omar.7tech@gmail.com
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:+96171387946" class="text-xs">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        +961 71 387 946
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </footer>
@endif
