@props(['categories' => [] , "content" => []])
<div class="py-16">

    <section class="container mx-auto px-4 relative z-10">
        <!-- Animated header with gradient text -->
        <div class="text-center mb-16">
            <span class="inline-block text-sm font-semibold text-primary mb-3 tracking-widest">EXPLORE COLLECTIONS</span>
            <h2
                class="text-4xl md:text-6xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary p-5">
                Shop by Category
            </h2>
        </div>

        <!-- Asymmetric category grid with floating effect -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($categories as $index => $category)
                <div class=" relative group" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                    <!-- Floating card with 3D effect -->
                    <div class="relative h-full transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                        :style="hover ? 'transform: perspective(1000px) rotateY(10deg) rotateX(-5deg) translateZ(20px)' :
                            'transform: perspective(1000px) rotateY(0) rotateX(0) translateZ(0)'">

                        <div class="hidden lg:block">
                            <x-categories.card :category="$category" :floating="true" />
                        </div>
                        <div class="block lg:hidden">
                            <x-categories.card3 :category="$category" $:content="" />
                        </div>

                    </div>

                    <!-- Floating shadow -->
                    <div class="absolute inset-0 rounded-2xl bg-black/10 blur-md scale-95 -z-10 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                        :style="hover ? 'transform: translateY(15px) scale(0.95)' : 'transform: translateY(0) scale(0.95)'">
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Animated "View All" button -->
        <div class="text-center mt-20">
            <a href="/categories"
                class="relative inline-flex items-center px-8 py-4 overflow-hidden text-lg font-bold text-white rounded-full group"
                style="background: linear-gradient(45deg, #3b82f6, #8b5cf6)">
                <span class="relative z-10 flex items-center">
                    View All Categories
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ml-3 transition-transform duration-300 group-hover:translate-x-2"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <span
                    class="absolute inset-0 bg-gradient-to-r from-primary to-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
            </a>
        </div>
    </section>
</div>
