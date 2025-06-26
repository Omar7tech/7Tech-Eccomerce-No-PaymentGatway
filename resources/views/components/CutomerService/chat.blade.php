<div class="fixed bottom-6 right-6 z-50" x-data="{ isHovered: false, showTooltip: false }">
    <!-- Chat Button -->

    <a href="{{ $customerService->directChatLink ?: '#' }}" target="_blank"
        @mouseenter="isHovered = true; showTooltip = true"
        @mouseleave="isHovered = false; setTimeout(() => showTooltip = false, 200)"
        class="btn btn-primary btn-circle btn-lg shadow-xl hover:shadow-2xl transition-all duration-300 relative group"
        :class="{ 'scale-110': isHovered }">

        <!-- Chat Icon -->
        <svg class="w-7 h-7 transition-transform duration-300" :class="{ 'scale-110': isHovered }" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
            </path>
        </svg>

        <!-- Pulse Animation -->
        <span class="absolute inset-0 rounded-full bg-primary opacity-30 animate-ping"></span>

        <!-- Online Indicator -->
        <div class="absolute -top-1 -right-1 w-4 h-4 bg-success rounded-full border-2 border-base-100 animate-pulse">
        </div>
    </a>

    <!-- Tooltip -->
    <div x-show="showTooltip" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform translate-x-2"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-2"
        class="absolute right-full mr-4 top-1/2 transform -translate-y-1/2 bg-base-300 text-base-content px-3 py-2 rounded-lg shadow-lg whitespace-nowrap text-sm font-medium"
        x-cloak>
        Chat with us!
        <!-- Tooltip Arrow -->
        <div
            class="absolute left-full top-1/2 transform -translate-y-1/2 w-0 h-0 border-l-4 border-l-base-300 border-t-4 border-t-transparent border-b-4 border-b-transparent">
        </div>
    </div>
</div>
