@props(['category' => null , "content" => []])

<a href="{{ route('products', ['c' => $category]) }}" wire:navigate>
    <div class="rounded-md overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 w-full max-w-xs">
        <img
            src="{{ $category->image && ($content->category_display_image == true) ? Storage::url($category->image) : 'https://placehold.co/300x200?font=montserrat&text='.$category->name }}"
            alt="{{ $category->name }}"
            class="w-full h-32 object-cover"
            loading="lazy"
        />
        <div class="p-3 bg-base-300">
            <h3 class="text-base font-medium  truncate">
                {{ $category->name }}
            </h3>
            <p class="text-xs text-gray-500">
                {{ $category->products->count() }} products
            </p>
        </div>
    </div>
</a>
