<!-- Contact Widget V3 - Modern Slide-Out Drawer Design -->
@if ($contact->contact_enabled)
    <div class="fixed bottom-6 right-6 z-50" x-data="{
        isOpen: false,
        isHovered: false,
        activeOption: null
    }">

        <!-- Enhanced Backdrop with Gradient -->
        <div x-show="isOpen"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gradient-to-br from-base-content/10 via-base-content/20 to-base-content/30 backdrop-blur-md"
             @click="isOpen = false"
             x-cloak>
        </div>

        <!-- Contact Drawer -->
        <div x-show="isOpen"
             x-transition:enter="transition ease-out duration-500 transform"
             x-transition:enter-start="opacity-0 translate-x-full translate-y-4 scale-90"
             x-transition:enter-end="opacity-100 translate-x-0 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-300 transform"
             x-transition:leave-start="opacity-100 translate-x-0 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-x-full translate-y-4 scale-90"
             class="absolute bottom-20 right-0 w-80 bg-base-100 rounded-2xl shadow-2xl border border-base-300/50 overflow-hidden backdrop-blur-xl"
             x-cloak>

            <!-- Drawer Header with Gradient -->
            <div class="relative px-6 py-5 bg-gradient-to-r from-primary/5 via-secondary/5 to-accent/5 border-b border-base-300/30">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-transparent opacity-50"></div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                        </div>
                        <h3 class="text-xl font-bold text-base-content">Let's Connect</h3>
                    </div>
                    <p class="text-sm text-base-content/70 leading-relaxed">
                        Ready to help you succeed. Choose your preferred contact method below.
                    </p>
                </div>
            </div>

            <!-- Contact Options Grid -->
            <div class="p-4 space-y-3">
                @if ($contact->whatsapp_enabled && $contact->whatsapp_number)
                    <!-- WhatsApp Option -->
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp_number) }}"
                       target="_blank"
                       @mouseenter="activeOption = 'whatsapp'"
                       @mouseleave="activeOption = null"
                       class="group relative flex items-center gap-4 p-4 rounded-xl border-2 border-transparent hover:border-success/30 hover:bg-success/5 transition-all duration-300 transform hover:scale-[1.02] cursor-pointer">

                        <!-- Icon Container -->
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-br from-success to-success/80 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-success/25 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 fill-white transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.570-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </div>
                            <!-- Online Indicator -->
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-success rounded-full border-2 border-base-100 flex items-center justify-center">
                                <div class="w-2 h-2 bg-base-100 rounded-full"></div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-bold text-base-content group-hover:text-success transition-colors duration-300">WhatsApp Chat</h4>
                                <div class="px-2 py-1 bg-success/20 text-success text-xs rounded-full font-medium group-hover:bg-success/30 transition-colors duration-300">
                                    Instant
                                </div>
                            </div>
                            <p class="text-sm text-base-content/70 group-hover:text-base-content/90 transition-colors duration-300">
                                Get real-time support and quick responses
                            </p>
                        </div>

                        <!-- Arrow Indicator -->
                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-0 group-hover:translate-x-1">
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>

                        <!-- Hover Glow Effect -->
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-success/0 via-success/5 to-success/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                @endif

                @if ($contact->phone_number_enabled && $contact->phone_number)
                    <!-- Phone Option -->
                    <a href="tel:{{ $contact->phone_number }}"
                       @mouseenter="activeOption = 'phone'"
                       @mouseleave="activeOption = null"
                       class="group relative flex items-center gap-4 p-4 rounded-xl border-2 border-transparent hover:border-info/30 hover:bg-info/5 transition-all duration-300 transform hover:scale-[1.02] cursor-pointer">

                        <!-- Icon Container -->
                        <div class="w-12 h-12 bg-gradient-to-br from-info to-info/80 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-info/25 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 fill-white transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-bold text-base-content group-hover:text-info transition-colors duration-300">Direct Call</h4>
                                <div class="px-2 py-1 bg-info/20 text-info text-xs rounded-full font-medium group-hover:bg-info/30 transition-colors duration-300">
                                    24/7
                                </div>
                            </div>
                            <p class="text-sm text-base-content/70 group-hover:text-base-content/90 transition-colors duration-300">
                                Speak directly with our support team
                            </p>
                        </div>

                        <!-- Arrow Indicator -->
                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-0 group-hover:translate-x-1">
                            <svg class="w-5 h-5 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>

                        <!-- Hover Glow Effect -->
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-info/0 via-info/5 to-info/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                @endif

                @if ($contact->email_enabled && $contact->email)
                    <!-- Email Option -->
                    <a href="mailto:{{ $contact->email }}"
                       @mouseenter="activeOption = 'email'"
                       @mouseleave="activeOption = null"
                       class="group relative flex items-center gap-4 p-4 rounded-xl border-2 border-transparent hover:border-warning/30 hover:bg-warning/5 transition-all duration-300 transform hover:scale-[1.02] cursor-pointer">

                        <!-- Icon Container -->
                        <div class="w-12 h-12 bg-gradient-to-br from-warning to-warning/80 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-warning/25 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6 fill-white transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-bold text-base-content group-hover:text-warning transition-colors duration-300">Send Email</h4>
                                <div class="px-2 py-1 bg-warning/20 text-warning text-xs rounded-full font-medium group-hover:bg-warning/30 transition-colors duration-300">
                                    Detailed
                                </div>
                            </div>
                            <p class="text-sm text-base-content/70 group-hover:text-base-content/90 transition-colors duration-300">
                                Perfect for detailed inquiries and attachments
                            </p>
                        </div>

                        <!-- Arrow Indicator -->
                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-0 group-hover:translate-x-1">
                            <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>

                        <!-- Hover Glow Effect -->
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-warning/0 via-warning/5 to-warning/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                @endif
            </div>

            <!-- Footer with Additional Info -->
            <div class="px-6 py-4 bg-base-200/50 border-t border-base-300/30">
                <div class="flex items-center justify-between text-xs text-base-content/60">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                        <span>We're online now</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                        <span>Available worldwide</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Floating Action Button -->
        <div class="relative">
            <!-- Animated Pulse Rings -->
            <div class="absolute inset-0 rounded-full bg-primary/20 scale-100 animate-ping"
                 :class="{ 'animate-none opacity-0': isOpen }"></div>
            <div class="absolute inset-0 rounded-full bg-primary/10 scale-110 animate-ping animation-delay-75"
                 :class="{ 'animate-none opacity-0': isOpen }"></div>

            <!-- Main Button -->
            <button @click="isOpen = !isOpen"
                    @mouseenter="isHovered = true"
                    @mouseleave="isHovered = false"
                    class="relative btn btn-primary btn-lg w-16 h-16 rounded-full shadow-2xl hover:shadow-primary/30 transition-all duration-300 group overflow-hidden border-4 border-base-100"
                    :class="{
                        'btn-error scale-110 rotate-45': isOpen,
                        'hover:scale-105 hover:-translate-y-1': !isOpen && isHovered
                    }">

                <!-- Contact Icon (when closed) -->
                <div x-show="!isOpen" class="transition-all duration-300">
                    <svg class="w-8 h-8 transition-all duration-300 group-hover:scale-110"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 4v-4z"/>
                    </svg>
                </div>

                <!-- Close Icon (when open) -->
                <div x-show="isOpen" class="transition-all duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <!-- Shimmer Effect -->
                <div class="absolute inset-0 -top-full bg-gradient-to-b from-transparent via-white/20 to-transparent skew-y-12 group-hover:animate-shimmer"></div>

                <!-- Radial Glow -->
                <div class="absolute inset-0 rounded-full bg-gradient-radial from-primary/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 scale-150"></div>
            </button>

            <!-- Dynamic Tooltip -->
            <div x-show="isHovered && !isOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90 translate-x-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-x-0"
                 x-transition:leave-end="opacity-0 scale-90 translate-x-4"
                 class="absolute right-full mr-4 top-1/2 transform -translate-y-1/2 z-10"
                 x-cloak>
                <div class="bg-base-content text-base-100 px-4 py-3 rounded-xl text-sm font-medium whitespace-nowrap shadow-xl border border-base-content/20">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                        <span>Need help? We're here!</span>
                    </div>
                    <div class="absolute left-full top-1/2 transform -translate-y-1/2 border-8 border-transparent border-l-base-content"></div>
                </div>
            </div>

            <!-- Notification Badge -->
            <div class="absolute -top-2 -left-2 w-6 h-6 bg-error rounded-full border-3 border-base-100 flex items-center justify-center text-xs font-bold text-error-content"
                 x-show="!isOpen && !isHovered">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                </svg>
            </div>
        </div>
    </div>
@endif

<style>
    [x-cloak] {
        display: none !important;
    }

    .animate-ping {
        animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    .animation-delay-75 {
        animation-delay: 0.75s;
    }

    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    @keyframes shimmer {
        0% { transform: translateY(-100%) skewY(12deg); }
        100% { transform: translateY(200%) skewY(12deg); }
    }

    .animate-shimmer {
        animation: shimmer 2s ease-in-out;
    }

    .bg-gradient-radial {
        background: radial-gradient(circle, var(--tw-gradient-stops));
    }

    .backdrop-blur-md {
        backdrop-filter: blur(12px);
    }

    .backdrop-blur-xl {
        backdrop-filter: blur(24px);
    }

    /* Enhanced transitions for smooth interactions */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .group:hover .group-hover\:translate-x-1 {
        transform: translateX(0.25rem);
    }

    /* Custom scrollbar for drawer if content overflows */
    .drawer-content::-webkit-scrollbar {
        width: 4px;
    }

    .drawer-content::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .drawer-content::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }

    .drawer-content::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.3);
    }
</style>