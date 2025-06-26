@props(['footer' , 'settings'])

@if ($footer->footer_enabled)
    <footer class=" overflow-hidden">


        <div class=" bg-base-200 pt-16 pb-8">
            <div class="container mx-auto px-4 max-w-7xl">
                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-12">

                    <!-- Company Info Section -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="group">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 bg-primary rounded-xl blur-lg opacity-30 group-hover:opacity-50 transition-opacity duration-300">
                                    </div>
                                    <div class="relative bg-gradient-to-br from-primary to-secondary p-2 rounded-xl">
                                        <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                                             alt="Logo"
                                             class="h-8 w-8 object-contain">
                                    </div>
                                </div>
                                <div>
                                    <h2
                                        class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                                        {{ $settings->site_name }}
                                    </h2>
                                    <div
                                        class="h-0.5 w-0 bg-gradient-to-r from-primary to-secondary transition-all duration-500 group-hover:w-full">
                                    </div>
                                </div>
                            </div>


                            @if ($footer->footer_text)
                                <div class="prose prose-sm max-w-none">
                                    <p class="text-base-content/80 leading-relaxed text-sm">
                                        {!! Str::markdown($footer->footer_text) !!}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Social Media Links -->
                        @if (!empty($footer->footer_socials))
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-base-content flex items-center gap-2">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                                        </path>
                                    </svg>
                                    Follow Us
                                </h3>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($footer->footer_socials as $social)
                                        <div class="tooltip" data-tip="{{ $social['platform'] }}">
                                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                                class="btn btn-circle btn-outline btn-sm hover:btn-primary group transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                                @if (isset($social['icon_url']))
                                                    <img src="{{ $social['icon_url'] }}" alt="{{ $social['platform'] }}"
                                                        class="w-4 h-4 group-hover:animate-pulse"
                                                        onerror="this.style.display='none'; this.parentNode.innerHTML='<svg class=\'w-4 h-4\' fill=\'currentColor\' viewBox=\'0 0 24 24\'><path d=\'M5.41 21L6.12 17H2.12L2.47 15H6.47L7.53 9H3.53L3.88 7H7.88L8.59 3H10.59L9.88 7H15.88L16.59 3H18.59L17.88 7H21.88L21.53 9H17.53L16.47 15H20.47L20.12 17H16.12L15.41 21H13.41L14.12 17H8.12L7.41 21H5.41ZM9.53 9L8.47 15H14.47L15.53 9H9.53Z\'></path></svg>'">
                                                @else
                                                    <span
                                                        class="text-xs font-bold">{{ substr($social['platform'], 0, 1) }}</span>
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Links Section -->
                    @if (!empty($footer->footer_links))
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-base-content flex items-center gap-2 group">
                                <svg class="w-5 h-5 text-primary group-hover:animate-spin" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                    </path>
                                </svg>
                                Quick Links
                            </h3>
                            <ul class="space-y-3">
                                @foreach ($footer->footer_links as $link)
                                    <li>
                                        <a href="{{ $link['url'] }}"
                                            class="flex items-center gap-2 text-base-content/70 hover:text-primary transition-all duration-300 hover:translate-x-1 group">
                                            <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            <span class="hover:underline underline-offset-4">{{ $link['label'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (!empty($footer->footer_phones) || !empty($footer->footer_emails))
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-base-content flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary animate-pulse" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                Contact
                            </h3>
                            <ul class="space-y-3">
                                @if (!empty($footer->footer_phones))
                                    @foreach ($footer->footer_phones as $phone)
                                        <li class="group">
                                            <a href="tel:{{ $phone['number'] }}"
                                                class="flex items-center gap-3 p-2 rounded-lg hover:bg-base-300 transition-all duration-300">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center group-hover:bg-primary/20">
                                                    <svg class="w-4 h-4 text-primary" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <span
                                                    class="text-base-content/80 text-sm group-hover:text-primary">{{ $phone['number'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif

                                @if (!empty($footer->footer_emails))
                                    @foreach ($footer->footer_emails as $email)
                                        <li class="group">
                                            <a href="mailto:{{ $email['address'] }}"
                                                class="flex items-center gap-3 p-2 rounded-lg hover:bg-base-300 transition-all duration-300">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 bg-secondary/10 rounded-full flex items-center justify-center group-hover:bg-secondary/20">
                                                    <svg class="w-4 h-4 text-secondary" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span
                                                class="text-base-content/80 text-sm group-hover:text-secondary break-all">{{ $email['address'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endif
                <!-- Contact Info Section -->


                <!-- Location Section (Separated) -->
                @if (!empty($footer->footer_locations))
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-base-content flex items-center gap-2">
                            <svg class="w-5 h-5 text-accent animate-bounce" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Locations
                        </h3>
                        <ul class="space-y-3">
                            @foreach ($footer->footer_locations as $location)
                                <li class="group">
                                    <a href="{{ $location['url'] }}" target="_blank" rel="noopener noreferrer"
                                        class="flex items-start gap-3 p-3 rounded-lg hover:bg-base-300 border border-transparent hover:border-accent/20 transition-all duration-300 hover:shadow-md">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-accent/10 rounded-full flex items-center justify-center group-hover:bg-accent/20 mt-0.5">
                                            <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span
                                                class="text-base-content/80 text-sm group-hover:text-accent block leading-relaxed">
                                                {{ $location['name'] }}
                                            </span>
                                            <span
                                                class="text-xs text-base-content/50 group-hover:text-accent/70 flex items-center gap-1 mt-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                    </path>
                                                </svg>
                                                View on Map
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Divider with Animation -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-base-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <div class="bg-base-200 px-4">
                        <div class="w-8 h-0.5 bg-gradient-to-r from-primary via-secondary to-accent animate-pulse">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="text-center space-y-4">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-base-content/60">
                        &copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.
                    </p>
                    <div class="flex items-center gap-4 text-xs text-base-content/50">
                        <a href="#" class="hover:text-primary transition-colors">Privacy Policy</a>
                        <span>•</span>
                        <a href="#" class="hover:text-primary transition-colors">Terms of Service</a>
                        <span>•</span>
                        <a href="#" class="hover:text-primary transition-colors">Cookie Policy</a>
                    </div>
                </div>

                <!-- Developer Credit -->
                <div class="text-center space-y-2 pt-4 border-t border-base-300/50">
                    <p class="text-xs text-base-content/40">
                        Developed with ❤️ by
                        <span class="font-semibold text-primary hover:text-primary/80 transition-colors">Omar7Tech</span>
                    </p>
                    <div class="flex justify-center items-center gap-4 text-xs text-base-content/30">
                        <a href="mailto:omar.7tech@gmail.com"
                           class="flex items-center gap-1 hover:text-primary transition-colors group">
                            <svg class="w-3 h-3 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            omar.7tech@gmail.com
                        </a>
                        <span>•</span>
                        <a href="tel:+96171387946"
                           class="flex items-center gap-1 hover:text-primary transition-colors group">
                            <svg class="w-3 h-3 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            +961 71 387 946
                        </a>
                    </div>
                </div>

                <!-- Back to Top Button -->
                <div class="pt-4">
                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                        class="btn btn-circle btn-outline btn-sm hover:btn-primary group">
                        <svg class="w-4 h-4 group-hover:animate-bounce" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 15l7-7 7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</footer>


@endif
