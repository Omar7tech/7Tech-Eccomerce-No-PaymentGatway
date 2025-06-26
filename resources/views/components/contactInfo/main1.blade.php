<!-- Enhanced Contact Widget Component -->
@if ($contact->contact_enabled)
    <div class="fixed bottom-6 left-6 z-50" x-data="{ isOpen: false, isHovered: false }">
        <!-- Background Blur Overlay -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[-1]" @click="isOpen = false" x-cloak>
        </div>

        <!-- Contact Menu Options -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="absolute bottom-full mb-6 left-0 bg-base-100 rounded-3xl shadow-2xl border border-base-300/50 overflow-hidden min-w-80 backdrop-blur-xl"
            x-cloak>

            <!-- Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-primary/5 to-secondary/5 border-b border-base-300/30">
                <h3 class="text-lg font-bold text-base-content">Get in Touch</h3>
                <p class="text-sm text-base-content/70 mt-1">Choose your preferred contact method</p>
            </div>

            @if ($contact->whatsapp_enabled && $contact->whatsapp_number)
                <!-- WhatsApp Option -->
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp_number) }}" target="_blank"
                    class="flex items-center gap-4 px-6 py-5 hover:bg-success/10 transition-all duration-300 group border-b border-base-300/30 last:border-b-0">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-success to-success/80 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-all duration-300">
                        <svg class="w-8 h-8 fill-white" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.570-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="font-bold text-base-content group-hover:text-success text-lg">WhatsApp Chat</div>
                        <div class="text-sm text-base-content/70 mt-1">Get instant responses to your questions</div>
                        <div
                            class="text-xs text-success font-medium mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Click to start chatting →</div>
                    </div>
                </a>
            @endif

            @if ($contact->phone_number_enabled && $contact->phone_number)
                <!-- Phone Option -->
                <a href="tel:{{ $contact->phone_number }}"
                    class="flex items-center gap-4 px-6 py-5 hover:bg-info/10 transition-all duration-300 group border-b border-base-300/30 last:border-b-0">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-info to-info/80 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 fill-white" viewBox="0 0 24 24">
                            <path
                                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="font-bold text-base-content group-hover:text-info text-lg">Call Direct</div>
                        <div class="text-sm text-base-content/70 mt-1">Speak with our support team now</div>
                        <div
                            class="text-xs text-info font-medium mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Tap to call now →</div>
                    </div>
                </a>
            @endif

            @if ($contact->email_enabled && $contact->email)
                <!-- Email Option -->
                <a href="mailto:{{ $contact->email }}"
                    class="flex items-center gap-4 px-6 py-5 hover:bg-warning/10 transition-all duration-300 group">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-warning to-warning/80 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 fill-white" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="font-bold text-base-content group-hover:text-warning text-lg">Send Email</div>
                        <div class="text-sm text-base-content/70 mt-1">Write us for detailed inquiries</div>
                        <div
                            class="text-xs text-warning font-medium mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Open email client →</div>
                    </div>
                </a>
            @endif
        </div>

        <!-- Main Contact Button -->
        <button @click="isOpen = !isOpen" @mouseenter="isHovered = true" @mouseleave="isHovered = false"
            class="btn btn-primary btn-lg w-16 h-16 rounded-full shadow-2xl hover:shadow-primary/25 transition-all duration-300 relative group border-3 border-base-100"
            :class="{
                'scale-110 bg-error border-error': isOpen,
                'scale-105 shadow-xl': isHovered && !isOpen,
                'animate-pulse': !isOpen
            }">

            <!-- Contact Icon (when closed) -->
            <svg x-show="!isOpen" class="w-8 h-8 transition-all duration-300" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                </path>
            </svg>

            <!-- Close Icon (when open) -->
            <svg x-show="isOpen" class="w-8 h-8 transition-all duration-300" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>

            <!-- Online Status Indicator -->
            <div class="absolute -top-2 -right-2 w-6 h-6 bg-success rounded-full border-4 border-base-100 flex items-center justify-center"
                x-show="!isOpen">
                <div class="w-2 h-2 bg-base-100 rounded-full animate-ping"></div>
            </div>

            <!-- Ripple Effect -->
            <div
                class="absolute inset-0 rounded-full bg-primary/20 scale-0 group-hover:scale-150 transition-transform duration-500 -z-10">
            </div>
        </button>

        <!-- Helper Text -->
        <div class="absolute bottom-full right-1/2 transform -translate-x-1/2 mb-4 px-4 py-2 bg-base-content text-base-100 text-sm rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap pointer-events-none"
            :class="{ 'opacity-0': isOpen }" x-show="isHovered && !isOpen">
            Need help? Click to contact us!
            <div
                class="absolute top-full right-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-base-content">
            </div>
        </div>
    </div>
@endif

<style>
    [x-cloak] {
        display: none !important;
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .8;
        }
    }

    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }

    .backdrop-blur-xl {
        backdrop-filter: blur(24px);
    }
</style>
