@props(['banners' => []])
@php $bannerCount = count($banners); @endphp

<div x-data="{
    currentIndex: 0,
    touchStartX: 0,
    intervalId: null,
    init() {
        // Start auto-scroll when component loads
        this.startAutoScroll();

        // Clean up interval when component is removed
        this.$watch('currentIndex', (value) => {
            if (value >= {{ $bannerCount }}) {
                this.currentIndex = 0;
            }
        });
    },
    startAutoScroll() {
        this.intervalId = setInterval(() => {
            this.next();
        }, 3000);
    },
    stopAutoScroll() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
            this.intervalId = null;
        }
    },
    next() {
        this.currentIndex = (this.currentIndex + 1) % {{ $bannerCount }};
        this.scrollTo(this.currentIndex);
    },
    scrollTo(index) {
        this.currentIndex = index;
        const container = this.$refs.slider;
        const width = container.offsetWidth;
        container.scrollTo({ left: width * index, behavior: 'smooth' });
    },
    handleTouchStart(e) {
        this.touchStartX = e.touches[0].clientX;
        this.stopAutoScroll(); // Pause auto-scroll during interaction
    },
    handleTouchEnd(e) {
        const touchEndX = e.changedTouches[0].clientX;
        const diff = this.touchStartX - touchEndX;

        if (diff > 50 && this.currentIndex < {{ $bannerCount }} - 1) {
            this.scrollTo(this.currentIndex + 1);
        } else if (diff < -50 && this.currentIndex > 0) {
            this.scrollTo(this.currentIndex - 1);
        }

        // Resume auto-scroll after 5 seconds of inactivity
        setTimeout(() => {
            if (!this.intervalId) {
                this.startAutoScroll();
            }
        }, 5000);
    }
}" class="relative overflow-hidden bg-base-200 h-64 md:h-96 animate__animated animate__fadeIn"
    @mouseenter="stopAutoScroll()" @mouseleave="startAutoScroll()">
    <div x-ref="slider" @touchstart="handleTouchStart" @touchend="handleTouchEnd"
        class="flex h-full transition-all duration-700 scroll-smooth overflow-x-hidden">
        @forelse ($banners as $banner)
            <div class="w-full flex-shrink-0 h-full">
                <div class="hero h-full" style="background-image: url('{{ Storage::url($banner->image_url) }}');"
                    loading="lazy" aria-label="{{ $banner->title }} banner">
                    <div class="hero-overlay bg-black opacity-80"></div>
                    <div class="hero-content text-center text-neutral-content">
                        <div class="max-w-md animate__animated animate__fadeInUp">
                            <h1 class="mb-5 text-4xl md:text-5xl font-bold">{{ $banner->title }}</h1>
                            <p class="mb-5">{{ $banner->description ?? $banner->title }}</p>
                            @php
                                $isExternal =
                                    $banner->link_url &&
                                    !str_starts_with($banner->link_url, request()->getSchemeAndHttpHost());
                            @endphp
                            @if ($isExternal)
                                <a href="{{ $banner->link_url }}" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-secondary hover:scale-105 transition-transform">Shop Now</a>
                            @else
                                <a wire:navigate href="{{ $banner->link_url }}"
                                    class="btn btn-secondary hover:scale-105 transition-transform">Shop Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="w-full flex items-center justify-center">
                <p class="text-gray-500">No banners available</p>
            </div>
        @endforelse
    </div>

    @if ($bannerCount > 1)
        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
            @for ($i = 0; $i < $bannerCount; $i++)
                <button @click="scrollTo({{ $i }})" @mouseenter="stopAutoScroll()"
                    @mouseleave="setTimeout(() => startAutoScroll(), 1000)"
                    :class="{
                        'bg-primary': currentIndex === {{ $i }},
                        'bg-gray-400': currentIndex !==
                            {{ $i }}
                    }"
                    class="w-3 h-3 rounded-full transition-all duration-300"
                    aria-label="Go to slide {{ $i + 1 }}"></button>
            @endfor
        </div>
    @endif
</div>
