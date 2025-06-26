<div class="py-20 bg-gradient-to-b from-base-100 to-base-200/30" x-data="{
    currentTranslate: 0,
    animationSpeed: 0.5, // pixels per frame
    containerWidth: 0,
    totalWidth: 0,
    testimonials: {{ count($testimonials) }},

    init() {
        this.setupSmoothSliding();
        this.startAnimation();
    },

    setupSmoothSliding() {
        this.$nextTick(() => {
            const container = this.$refs.slider;
            const firstSlide = container.querySelector('.slide-item');
            if (firstSlide) {
                this.containerWidth = container.offsetWidth;
                // Calculate total width needed for smooth infinite scroll
                this.totalWidth = firstSlide.offsetWidth * this.testimonials;
                this.duplicateSlides();
            }
        });
    },

    duplicateSlides() {
        // Duplicate slides for seamless infinite scroll
        const container = this.$refs.slider;
        const slides = container.querySelectorAll('.slide-item');
        slides.forEach(slide => {
            const clone = slide.cloneNode(true);
            container.appendChild(clone);
        });
    },

    startAnimation() {
        const animate = () => {
            this.currentTranslate -= this.animationSpeed;

            // Reset when we've scrolled through all original slides
            if (Math.abs(this.currentTranslate) >= this.totalWidth) {
                this.currentTranslate = 0;
            }
            requestAnimationFrame(animate);
        };
        requestAnimationFrame(animate);
    }
}">

    <div class="max-w-7xl mx-auto px-6 relative">
        <!-- Professional Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-base-content mb-4">
                {{ $content->testimonial_title }}
            </h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                {{ $content->testimonial_description }}
            </p>
        </div>

        <!-- Smooth Sliding Carousel -->
        <div class="relative overflow-hidden">
            <div class="flex"
                 x-ref="slider"
                 :style="`transform: translateX(${currentTranslate}px); transition: none;`">

                @foreach ($testimonials as $testimonial)
                    <div class="slide-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-4">
                        <div class="bg-base-100 rounded-xl shadow-lg border border-base-300 p-8 h-full hover:shadow-xl transition-shadow duration-300">
                           

                            <!-- Testimonial Content -->
                            <blockquote class="text-base-content/90 text-base leading-relaxed mb-6 line-clamp-4">
                                "{{ $testimonial->content }}"
                            </blockquote>

                            <!-- Profile -->
                            <div class="flex items-center gap-4 pt-4 border-t border-base-300">
                                <div class="avatar">
                                    <div class="w-12 h-12 rounded-full">
                                        @if ($testimonial->image)
                                            <img src="{{ Storage::url($testimonial->image) }}"
                                                 alt="{{ $testimonial->name }}"
                                                 class="object-cover">
                                        @else
                                            <div class="bg-primary text-primary-content flex items-center justify-center text-lg font-semibold">
                                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base-content">{{ $testimonial->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>

    <style>
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth scrolling performance */
        .slide-item {
            will-change: transform;
        }

        /* Hide scrollbar */
        .overflow-hidden {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        .overflow-hidden::-webkit-scrollbar {
            display: none;  /* Chrome, Safari, Opera */
        }
    </style>
</div>