@props(['banners' => []])
@php $bannerCount = count($banners); @endphp

<div x-data="{
    currentIndex: 0,
    intervalId: null,
    startAutoScroll() {
        this.intervalId = setInterval(() => {
            this.next();
        }, 4000); // Auto-scroll every 4 seconds
    },
    stopAutoScroll() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
            this.intervalId = null;
        }
    },
    next() {
        this.currentIndex = (this.currentIndex + 1) % {{ $bannerCount }};
    },
    prev() {
        this.currentIndex = (this.currentIndex - 1 + {{ $bannerCount }}) % {{ $bannerCount }};
    },
    goTo(index) {
        this.currentIndex = index;
    },
    init() {
        this.startAutoScroll();
        this.$watch('currentIndex', value => {
            if (value >= {{ $bannerCount }}) {
                this.currentIndex = 0;
            }
        });
    }
}" x-init="init()" class="relative overflow-hidden">

    <!-- Carousel Images -->
    <div class="relative w-full h-64 md:h-96">
        <!-- Loop over banners dynamically -->
        @foreach ($banners as $index => $banner)
            <div x-show="currentIndex === {{ $index }}" x-transition:enter="transition ease-out duration-700"
                x-transition:leave="transition ease-in duration-700" class="absolute inset-0">
                <img src="{{ Storage::url($banner->image_url) }}" alt="{{ $banner->title }}"
                    class="w-full h-full object-cover" />
                <div
                    class="absolute left-0 right-0 bottom-0 p-4 bg-gradient-to-r from-base-100/90 via-base-100/60 to-transparent">
                    <h2 class="text-2xl font-bold">{{ $banner->title }}</h2>
                    <p class="text-sm">{{ $banner->description ?? 'Placeholder for description. Edit manually later.' }}
                    </p>
                    @php
                        $isExternal =
                            $banner->link_url && !str_starts_with($banner->link_url, request()->getSchemeAndHttpHost());
                    @endphp
                    @if ($isExternal)
                        <a href="{{ $banner->link_url }}" target="_blank" rel="noopener noreferrer"
                            class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-full">Learn More</a>
                    @else
                        <a wire:navigate href="{{ $banner->link_url }}"
                            class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-full">Learn More</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation Arrows and Dots -->
    <!-- Arrows + Dots Container -->
    <div class="flex justify-center items-center gap-4 mt-4">
        <!-- Left Arrow Button -->
        <button @click="prev()" @mouseenter="stopAutoScroll()" @mouseleave="startAutoScroll()"
            class="btn btn-circle bg-base-200 hover:bg-base-300 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </button>

        <!-- Dots -->
        <div class="flex gap-2">
            @foreach ($banners as $index => $banner)
                <button @click="goTo({{ $index }})"
                    :class="{
                        'bg-blue-500': currentIndex === {{ $index }},
                        'bg-gray-300': currentIndex !== {{ $index }}
                    }"
                    class="w-3 h-3 rounded-full transition-colors">
                </button>
            @endforeach
        </div>

        <!-- Right Arrow Button -->
        <button @click="next()" @mouseenter="stopAutoScroll()" @mouseleave="startAutoScroll()"
            class="btn btn-circle bg-base-200 hover:bg-base-300 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
            </svg>
        </button>
    </div>

</div>
