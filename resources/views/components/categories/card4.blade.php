@props(['category' => null , "content" => []])

<a href="{{ route('products', ['c' => $category]) }}" wire:navigate>
    <div class="relative rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300 w-full max-w-[10rem]">
        <img
            src="{{ $category->image && ($content->category_display_image == true) ? Storage::url($category->image) : 'https://placehold.co/300x200?font=montserrat&text=' . $category->name }}"
            alt="{{ $category->name }}"
            class="w-full h-28 object-cover"
            loading="lazy"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent">
            <div class="absolute bottom-2 left-2 right-2 text-white">
                <h3 class="text-sm font-semibold truncate">{{ $category->name }}</h3>
                <p class="text-xs text-white/80 mt-1">{{ $category->products->count() }} products</p>
            </div>
        </div>
    </div>
</a>
