@props(['category' => null , "content" => []])
<div class="group relative overflow-hidden rounded-lg shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-1 h-32 md:h-40">
    <!-- Image container with hover effect -->
    <div class="absolute inset-0">
        <img
            src="{{ $category->image && ($content->category_display_image == true) ? Storage::url($category->image) : 'https://placehold.co/400x300?font=montserrat&text='.$category->name }}"
            alt="{{ $category->name }}"
            class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105"
            loading="lazy"
        />
        <!-- Overlay that disappears on hover -->
        <div class="absolute inset-0 bg-black/50 transition-all duration-500 group-hover:opacity-0"></div>
    </div>

    <!-- Content with always-visible text and count -->
    <div class="relative z-10 h-full flex flex-col justify-end p-3">
        <!-- Text container with solid background on hover -->
        <div class="inline-block transition-all duration-300 group-hover:bg-black/70 group-hover:px-3 group-hover:py-1 group-hover:rounded-lg">
            <h3 class="text-lg font-semibold text-white mb-1">
                {{ $category->name }}
            </h3>
            <p class="text-xs text-white/80 mb-1">
                {{ $category->products->count() }} products
            </p>
            <span class="block w-6 h-0.5 bg-white transition-all duration-500 group-hover:w-8"></span>
        </div>

        <!-- Button that appears on hover -->
        <div class="mt-1">
            <a
                wire:navigate
                href="{{ route('products', ['c' => $category]) }}"
                class="inline-flex items-center px-3 py-1.5 bg-neutral text-xs font-medium rounded-md transition-all duration-500 transform translate-y-5 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 group-hover:bg-neutral/80 group-hover:text-white"
            >
                Browse
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Corner accent that remains visible -->
    <div class="absolute top-0 right-0 w-8 h-8 overflow-hidden">
        <div class="absolute -right-4 -top-4 w-8 h-8 bg-white/20 transform rotate-45 transition-all duration-500 group-hover:bg-white/30"></div>
    </div>
</div>
