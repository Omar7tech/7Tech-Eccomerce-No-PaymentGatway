<!-- Contact Widget V2 - DaisyUI Horizontal Design -->
@if ($contact->contact_enabled)
    <div class="fixed bottom-8 left-8 z-50" x-data="{
        isOpen: false,
        isHovered: false,
        showTooltip: false
    }">

        <!-- Backdrop -->
        <div x-show="isOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-base-content/20 backdrop-blur-sm"
             @click="isOpen = false"
             x-cloak>
        </div>

        <!-- Contact Options - Horizontal Layout -->
        <div x-show="isOpen"
             x-transition:enter="transition ease-out duration-400 transform"
             x-transition:enter-start="opacity-0 -translate-x-full scale-75"
             x-transition:enter-end="opacity-100 translate-x-0 scale-100"
             x-transition:leave="transition ease-in duration-250 transform"
             x-transition:leave-start="opacity-100 translate-x-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-x-full scale-75"
             class="absolute bottom-20 left-0 flex flex-col gap-3"
             x-cloak>

            @if ($contact->email_enabled && $contact->email)
                <!-- Email Option -->
                <div class="tooltip tooltip-right" data-tip="Send us an email">
                    <a href="mailto:{{ $contact->email }}"
                       class="btn btn-warning btn-lg gap-3 shadow-lg hover:shadow-xl transition-all duration-300 group min-w-48">
                        <div class="w-8 h-8 rounded-full bg-warning-content/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-bold text-sm">Email Us</div>
                            <div class="text-xs opacity-80">Detailed inquiry</div>
                        </div>
                    </a>
                </div>
            @endif

            @if ($contact->phone_number_enabled && $contact->phone_number)
                <!-- Phone Option -->
                <div class="tooltip tooltip-right" data-tip="Call us directly">
                    <a href="tel:{{ $contact->phone_number }}"
                       class="btn btn-info btn-lg gap-3 shadow-lg hover:shadow-xl transition-all duration-300 group min-w-48">
                        <div class="w-8 h-8 rounded-full bg-info-content/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-bold text-sm">Call Now</div>
                            <div class="text-xs opacity-80">Instant support</div>
                        </div>
                    </a>
                </div>
            @endif

            @if ($contact->whatsapp_enabled && $contact->whatsapp_number)
                <!-- WhatsApp Option -->
                <div class="tooltip tooltip-right" data-tip="Chat on WhatsApp">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp_number) }}"
                       target="_blank"
                       class="btn btn-success btn-lg gap-3 shadow-lg hover:shadow-xl transition-all duration-300 group min-w-48">
                        <div class="w-8 h-8 rounded-full bg-success-content/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.570-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-bold text-sm">WhatsApp</div>
                            <div class="text-xs opacity-80">Quick chat</div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Contact Header Card -->
            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body py-4 px-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 fill-primary" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-base-content text-lg">We're Here to Help!</h3>
                            <p class="text-base-content/70 text-sm">Choose your preferred way to reach us</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Floating Action Button -->
        <div class="relative">
            <!-- Pulse Ring -->
            <div class="absolute inset-0 rounded-full bg-primary/30 animate-ping"
                 :class="{ 'animate-none': isOpen }"></div>

            <!-- Status Indicator -->
            <div class="absolute -top-1 -right-1 w-4 h-4 bg-success rounded-full border-2 border-base-100 z-10"
                 x-show="!isOpen">
            </div>

            <!-- Main Button -->
            <button @click="isOpen = !isOpen"
                    @mouseenter="isHovered = true; showTooltip = true"
                    @mouseleave="isHovered = false; setTimeout(() => showTooltip = false, 100)"
                    class="btn btn-primary btn-lg w-16 h-16 rounded-full shadow-2xl relative overflow-hidden group"
                    :class="{
                        'btn-error scale-110': isOpen,
                        'hover:scale-105': !isOpen
                    }">

                <!-- Message Icon (when closed) -->
                <svg x-show="!isOpen"
                     class="w-7 h-7 transition-all duration-300 group-hover:scale-110"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>

                <!-- Close Icon (when open) -->
                <svg x-show="isOpen"
                     class="w-7 h-7 transition-all duration-300"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>

                <!-- Button Glow Effect -->
                <div class="absolute inset-0 rounded-full bg-gradient-to-r from-primary/0 via-primary/30 to-primary/0 scale-0 group-hover:scale-100 transition-transform duration-500"></div>
            </button>

            <!-- Floating Tooltip -->
            <div x-show="showTooltip && !isOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-x-2"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 -translate-x-2"
                 class="absolute left-full ml-4 top-1/2 transform -translate-y-1/2 z-10"
                 x-cloak>
                <div class="bg-base-content text-base-100 px-3 py-2 rounded-lg text-sm font-medium whitespace-nowrap shadow-lg">
                    Need help? Let's chat!
                    <div class="absolute right-full top-1/2 transform -translate-y-1/2 border-4 border-transparent border-r-base-content"></div>
                </div>
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

    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }
</style>