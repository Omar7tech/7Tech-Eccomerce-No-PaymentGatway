@props(['category'])

<section class="mx-auto px-4 py-8 bg-base-200 animate__animated animate__fadeIn">
    <div class="flex justify-between items-center mb-6 bg-base-200 pb-4">
        <h2 class="text-2xl sm:text-3xl font-bold">
            {{ $category->name }}
        </h2>
        <a wire:navigate href="{{ route('products', ["category=$category->slug"]) }}"
            class="btn btn-link hover:scale-105 transition-transform text-sm sm:text-base whitespace-nowrap">View All →</a>
    </div>

    {{-- Category Image Section with Name and Description Overlay --}}
    @if ($category->image)
        <div class="-mx-4 mb-8 relative overflow-hidden group shadow-md"> {{-- Rounded corners and shadow added for aesthetics --}}
            {{-- Skeleton Loader --}}
            <div class="skeleton w-full h-32 sm:h-40 md:h-48 lg:h-56 absolute inset-0 z-0 opacity-100 transition-opacity duration-300"
                 id="category-image-skeleton-{{ $category->slug }}"></div>

            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }} category banner"
                 class="w-full h-32 object-cover
                        sm:h-40 md:h-48 lg:h-56
                        transform group-hover:scale-105 transition-transform duration-500 ease-out relative z-10"
                 loading="lazy"
                 onload="document.getElementById('category-image-skeleton-{{ $category->slug }}').style.opacity = '0';"
            >

            {{-- Gradient overlay for text readability --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-20"></div>

            {{-- Text overlay: Category Name and Description --}}
            <div class="absolute bottom-0 left-0 right-0 p-4 text-white z-10">
                <h3 class="text-xl sm:text-2xl font-bold drop-shadow-lg">{{ $category->name }}</h3>
                @if ($category->description)
                    {{-- Use Str::limit to prevent overly long descriptions from breaking layout --}}
                    <p class="text-sm mt-1 opacity-90 drop-shadow hidden sm:block">{{ Str::limit($category->description, 120) }}</p>
                @endif
            </div>
        </div>
    @endif
    {{-- End Category Image Section --}}

    <div class="relative">
        <div class="flex overflow-x-auto pb-6 -mx-4 px-4 scrollbar-hide gap-3">
            @foreach ($category->products as $product)
                <div wire:key="{{ $product->slug }}"
                    class="flex-none w-[45%] sm:w-[30%] md:w-[25%] lg:w-[15%] min-w-[180px]">
                    <livewire:product-card :$product :key="$product->slug" />
                </div>
            @endforeach
        </div>
    </div>
</section>
