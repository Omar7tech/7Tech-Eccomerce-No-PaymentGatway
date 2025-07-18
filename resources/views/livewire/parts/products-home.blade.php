<div>
    <section class="container mx-auto px-4 py-8 bg-base-200 animate__animated animate__fadeIn">
        <div class="flex justify-between items-center mb-6 sticky top-0 bg-base-200 z-10 pb-4">
            <h2 class="text-2xl sm:text-3xl font-bold">
                Featured Products
            </h2>
            <a href="#" class="btn btn-link hover:scale-105 transition-transform text-sm sm:text-base">View All
                →</a>
        </div>

        <div class="relative">
            <div class="flex overflow-x-auto pb-6 -mx-4 px-4 scrollbar-hide gap-4 md:gap-6">
                @foreach ($products as $product)
                    <div wire:key="{{ $product->slug }}"
                        class="flex-none w-[45%] sm:w-[30%] md:w-[25%] lg:w-[0%] min-w-[180px]">
                        <livewire:product-card :$product :key="$product->slug" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
