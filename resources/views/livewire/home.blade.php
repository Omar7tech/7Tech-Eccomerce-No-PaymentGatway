@php
    // Define product sections and their properties
    $productSections = [
        'new' => ['component' => 'parts.new-products-home', 'enabled' => $content->new_products_enabled ?? true],
        'featured' => [
            'component' => 'parts.featured-products-home',
            'enabled' => $content->featured_products_enabled ?? true,
        ],
        'sale' => ['component' => 'parts.sale-products-home', 'enabled' => $content->sale_products_enabled ?? true],
    ];

    // Determine the order of sections, with a fallback to default order
    $sectionsOrder = collect(
        $content->product_sections_order ?? [['section' => 'new'], ['section' => 'featured'], ['section' => 'sale']],
    )
        ->pluck('section')
        ->toArray();

    // Determine the position of the sections block, with a fallback
    $position = $content->product_sections_position ?? 'after_showcase';

    // A closure to render the product sections based on order and enabled status
    $renderProductSections = function () use ($productSections, $sectionsOrder) {
        foreach ($sectionsOrder as $sectionName) {
            if (isset($productSections[$sectionName]) && $productSections[$sectionName]['enabled']) {
                echo app('livewire')->mount($productSections[$sectionName]['component']);
            }
        }
    };
@endphp

<div>

    @if ($content->hero_enabled)
        <x-hero.main :$content :$settings />
    @endif

    <!-- Hero Banner with Auto Scroll -->
    @if ($content->banner_active && $banners->isNotEmpty())
        @if ($content->banner_mode == 1)
            <x-banners.main :$banners />
        @else
            <x-banners.main2 :$banners />
        @endif
    @endif



    @if ($content->category_home_enabled && $categories->isNotEmpty())
        <div class="h-full w-full bg-gradient-to-br from-base-100 via-base-200 to-primary/20 relative overflow-hidden">
            {{-- Optional: Add subtle pattern overlay --}}
            <div class="absolute inset-0 opacity-5">
                <div class="h-full w-full"
                    style="background-image: radial-gradient(circle at 25% 25%, hsl(var(--primary)) 2px, transparent 2px), radial-gradient(circle at 75% 75%, hsl(var(--secondary)) 2px, transparent 2px); background-size: 15px 15px;">
                </div>
            </div>

            {{-- Content --}}
            <div class="relative z-10">
                <livewire:parts.categories :$categories />
            </div>
        </div>
    @endif

    @if ($position === 'before_showcase')
        {!! $renderProductSections() !!}
    @endif

    @if ($showcaseItems->isNotEmpty())
        @foreach ($showcaseItems as $item)
            @if ($item->products->count() > 0)
                @if ($item instanceof \App\Models\Category)
                    <x-categoryHomeDynamic.main2 :category="$item" />
                @elseif ($item instanceof \App\Models\Tag)
                    <x-tag-home-dynamic :tag="$item" />
                @endif
            @endif
        @endforeach
    @endif


    @if ($position === 'after_showcase')
        {!! $renderProductSections() !!}
    @endif


    <!-- Testimonials -->
    @if ($content->testimonial_active)
        <livewire:parts.testimonials />
    @endif



</div>
