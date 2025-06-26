<div class="card bg-base-100 shadow-lg w-80">
    <div class="card-body p-4 space-y-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h3 class="card-title text-sm">Filters</h3>
            @if ($search || $category || !empty($selectedTags))
                <button wire:click="resetFilters" class="btn btn-ghost btn-xs text-error">
                    Clear
                </button>
            @endif
        </div>

        <!-- Search -->
        <div class="form-control">
            <label class="label">
                <span class="label-text text-xs">Search</span>
            </label>
            <input type="text"
                   wire:model.live.debounce.500ms="search"
                   placeholder="Search products..."
                   class="input input-bordered input-sm">
        </div>

        <!-- Categories -->
        <div class="form-control">
            <label class="label">
                <span class="label-text text-xs">Category</span>
            </label>
            <select wire:model.live="category" class="select select-bordered select-sm">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tags -->
        @if ($tags && $tags->count() > 0)
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-xs">Tags</span>
                    @if (!empty($selectedTags))
                        <span class="badge badge-primary badge-xs">{{ count($selectedTags) }}</span>
                    @endif
                </label>
                <div class="max-h-full overflow-y-auto space-y-1">
                    @foreach ($tags as $tag)
                        @if ($tag->products_count > 0)
                            <label class="label cursor-pointer justify-start">
                                <input type="checkbox"
                                       wire:click="toggleTag({{ $tag->id }})"
                                       {{ in_array($tag->id, $selectedTags ?? []) ? 'checked' : '' }}
                                       class="checkbox checkbox-xs checkbox-primary mr-2">
                                <span class="label-text text-xs">{{ $tag->name }} ({{ $tag->products_count }})</span>
                            </label>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>