@props(['category' => null , "content" => []])

<a href="{{ route('products', ['c' => $category]) }}" wire:navigate>
    <div class="relative rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300 w-full max-w-xs">
        <img
            src="{{ $category->image && ($content->category_display_image == true) ? Storage::url($category->image) : 'https://placehold.co/400x300?font=montserrat&text=' . $category->name }}"
            alt="{{ $category->name }}"
            class="w-full h-36 object-cover"
            loading="lazy"
        />
        <div class="absolute bottom-0 left-0 right-0 bg-black/50 backdrop-blur-sm text-white text-sm p-2">
            <div class="font-semibold truncate">{{ $category->name }}</div>
            <div class="text-xs text-white/80">{{ $category->products->count() }} products</div>
        </div>
    </div>
</a>
