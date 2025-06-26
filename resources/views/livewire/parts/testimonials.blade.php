<div class="py-16 bg-gradient-to-br from-base-100 via-base-200 to-base-100" x-data="{
    currentIndex: 0,
    totalSlides: Math.ceil({{ count($testimonials) }} / 3), // Groups of 3 for lg screens
    totalTestimonials: {{ count($testimonials) }},
    isAutoPlaying: true,
    touchStartX: 0,
    touchEndX: 0,

    init() {
        this.autoSlide();
    },

    autoSlide() {
        if (!this.isAutoPlaying) return;
        setInterval(() => {
            if (this.isAutoPlaying && this.shouldAutoSlide()) {
                this.next();
            }
        }, 4500);
    },

    shouldAutoSlide() {
        // On lg screens: auto-slide only if more than 3 testimonials
        // On smaller screens: auto-slide only if more than 1 testimonial
        if (window.innerWidth >= 1024) {
            return this.totalTestimonials > 3;
        } else {
            return this.totalTestimonials > 1;
        }
    },

    goToSlide(index) {
        this.currentIndex = index;
        this.pauseAutoPlay();
    },

    next() {
        // For lg screens: groups of 3, for smaller: individual slides
        const maxSlides = window.innerWidth >= 1024 ? Math.ceil(this.totalTestimonials / 3) : this.totalTestimonials;
        this.currentIndex = this.currentIndex >= maxSlides - 1 ? 0 : this.currentIndex + 1;
    },

    prev() {
        const maxSlides = window.innerWidth >= 1024 ? Math.ceil(this.totalTestimonials / 3) : this.totalTestimonials;
        this.currentIndex = this.currentIndex <= 0 ? maxSlides - 1 : this.currentIndex - 1;
        this.pauseAutoPlay();
    },

    pauseAutoPlay() {
        this.isAutoPlaying = false;
        setTimeout(() => { this.isAutoPlaying = true; }, 8000);
    },

    handleTouchStart(e) {
        this.touchStartX = e.touches[0].clientX;
    },

    handleTouchEnd(e) {
        this.touchEndX = e.changedTouches[0].clientX;
        this.handleSwipe();
    },

    handleSwipe() {
        const swipeThreshold = 50;
        const diff = this.touchStartX - this.touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                this.next();
            } else {
                this.prev();
            }
            this.pauseAutoPlay();
        }
    },

    getCurrentSlideCount() {
        return window.innerWidth >= 1024 ? Math.ceil(this.totalTestimonials / 3) : this.totalTestimonials;
    }
}"
    x-init="
        window.addEventListener('resize', () => {
            if (currentIndex >= getCurrentSlideCount()) {
                currentIndex = 0;
            }
        });
    "
>
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-quote-left text-3xl text-primary mr-3"></i>
                <h2
                    class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    {{ $content->testimonial_title }}
                </h2>
            </div>
            <p class="text-base-content/70 text-lg max-w-2xl mx-auto">
                {{ $content->testimonial_description }}
            </p>
        </div>

        <div class="relative">
            <div class="overflow-hidden rounded-3xl" @touchstart="handleTouchStart($event)"
                @touchend="handleTouchEnd($event)">
                <div class="hidden lg:block">
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="`transform: translateX(-${currentIndex * 100}%)`">
                        @for ($slideIndex = 0; $slideIndex < ceil(count($testimonials) / 3); $slideIndex++)
                            <div class="w-full flex-shrink-0 px-4">
                                <div class="grid grid-cols-3 gap-6">
                                    @for ($i = 0; $i < 3; $i++)
                                        @php $testimonialIndex = $slideIndex * 3 + $i; @endphp
                                        @if (isset($testimonials[$testimonialIndex]))
                                            @php $testimonial = $testimonials[$testimonialIndex]; @endphp
                                            <div
                                                class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-base-300 group hover:scale-105">
                                                <div class="card-body items-center text-center p-6">
                                                    <div class="avatar mb-4">
                                                        <div
                                                            class="w-16 h-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2 group-hover:ring-secondary transition-all duration-300">
                                                            @if ($testimonial->image)
                                                                <img src="{{ Storage::url($testimonial->image) }}"
                                                                    alt="{{ $testimonial->name }}" class="object-cover">
                                                            @else
                                                                <div
                                                                    class="bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                                                    <span class="text-xl font-bold text-primary-content">
                                                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="flex gap-1 mb-3">
                                                        @for ($j = 1; $j <= 5; $j++)
                                                            <i class="fas fa-star text-warning text-sm"></i>
                                                        @endfor
                                                    </div>

                                                    <blockquote
                                                        class="text-sm text-base-content/90 leading-relaxed mb-4 line-clamp-4">
                                                        "{{ Str::limit($testimonial->content, 120) }}"
                                                    </blockquote>

                                                    <h3 class="font-bold text-base text-base-content">
                                                        {{ $testimonial->name }}
                                                    </h3>
                                                </div>
                                            </div>
                                        @else
                                            <div class="opacity-0"></div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="block lg:hidden">
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="`transform: translateX(-${currentIndex * 100}%)`">
                        @foreach ($testimonials as $index => $testimonial)
                            <div class="w-full flex-shrink-0 px-4">
                                <div class="card bg-base-100 shadow-2xl border border-base-300">
                                    <div class="card-body items-center text-center p-8 md:p-12">
                                        <div class="avatar mb-6">
                                            <div
                                                class="w-24 h-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                                @if ($testimonial->image)
                                                    <img src="{{ Storage::url($testimonial->image) }}"
                                                        alt="{{ $testimonial->name }}" class="object-cover">
                                                @else
                                                    <div
                                                        class="bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                                        <span class="text-3xl font-bold text-primary-content">
                                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex gap-1 mb-4">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-warning text-lg"></i>
                                            @endfor
                                        </div>

                                        <blockquote
                                            class="text-lg md:text-xl text-base-content/90 leading-relaxed mb-6 max-w-3xl">
                                            "{{ $testimonial->content }}"
                                        </blockquote>

                                        <h3 class="font-bold text-xl text-base-content">
                                            {{ $testimonial->name }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



            <div class="flex justify-center gap-2 mt-8">
                <div class="hidden lg:flex gap-2" x-show="{{ count($testimonials) }} > 3">
                    @for ($slideIndex = 0; $slideIndex < ceil(count($testimonials) / 3); $slideIndex++)
                        <button @click="goToSlide({{ $slideIndex }})"
                            class="w-3 h-3 rounded-full transition-all duration-300"
                            :class="currentIndex === {{ $slideIndex }} ? 'bg-primary scale-125 shadow-lg' :
                                'bg-base-300 hover:bg-base-content/30'"></button>
                    @endfor
                </div>

                <div class="flex lg:hidden gap-2" x-show="{{ count($testimonials) }} > 1">
                    @foreach ($testimonials as $index => $testimonial)
                        <button @click="goToSlide({{ $index }})"
                            class="w-3 h-3 rounded-full transition-all duration-300"
                            :class="currentIndex === {{ $index }} ? 'bg-primary scale-125 shadow-lg' :
                                'bg-base-300 hover:bg-base-content/30'"></button>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center mt-6" x-show="shouldAutoSlide()">
                <button @click="isAutoPlaying = !isAutoPlaying" class="btn btn-sm gap-2"
                    :class="isAutoPlaying ? 'btn-primary' : 'btn-outline'">
                    <div class="w-2 h-2 bg-current rounded-full" :class="isAutoPlaying ? 'animate-pulse' : ''"></div>
                    <span x-text="isAutoPlaying ? 'Auto-playing' : 'Paused'"></span>
                </button>
            </div>

            <div class="mt-4 max-w-xs mx-auto" x-show="isAutoPlaying && shouldAutoSlide()">
                <div class="h-1 bg-base-300 rounded-full overflow-hidden">
                    <div class="h-full bg-primary rounded-full slide-progress"></div>
                </div>
            </div>
        </div>
    </div>


    <style>
        @keyframes slideProgress {
            from {
                width: 0%;
            }

            to {
                width: 100%;
            }
        }

        .slide-progress {
            animation: slideProgress 4.5s linear infinite;
        }

        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>