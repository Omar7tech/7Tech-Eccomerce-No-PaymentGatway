<?php
// App\Livewire\Products.php
namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Services\WishlistService;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    use WithPagination;


    #[Url('c')] public $category = null;
    #[Url('tab')] public $activeTab = 'all';
    #[Url('sort')] public $sortBy = 'created_at';
    #[Url('order')] public $sortOrder = 'desc';
    #[Url('tags')] public $selectedTags = [];
    #[Url('search')] public $search = '';
    public $showWishlist = false;
    public $sort = 'newest';
    public $perPage = 12;

    // Component state
    public $showFilters = false;
    public $currentCategory = null;

    protected $queryString = [
        'activeTab' => ['except' => 'all'],
        'sortBy' => ['except' => 'created_at'],
        'sortOrder' => ['except' => 'desc'],
        'category' => ['except' => ''],
        'showWishlist' => ['except' => false],
    ];

    public function mount()
    {
        $this->currentCategory = $this->category ? Category::where('slug', $this->category)->first() : null;
    }

    public function updatedActiveTab($value)
    {
        $this->resetPage();
    }

    public function updatedSortBy($value)
    {
        $this->resetPage();
    }

    public function updatedSortOrder($value)
    {
        $this->resetPage();
    }

    public function updatedCategory($value)
    {
        $this->resetPage();
        $this->currentCategory = $value ? Category::where('slug', $value)->first() : null;
    }

    public function updatedShowWishlist($value)
    {
        $this->resetPage();
    }

    public function updatedSearch($value)
    {
        $this->resetPage();
    }

    public function updatedSort($value)
    {
        $this->resetPage();
    }

    public function toggleTag($tag)
    {
        if (in_array($tag, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tag]);
        } else {
            $this->selectedTags[] = $tag;
        }
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category', 'selectedTags', 'sortBy', 'sortOrder']);
        $this->currentCategory = null;
        $this->resetPage();
    }

    public function clearCategory()
    {
        $this->category = null;
        $this->currentCategory = null;
        $this->resetPage();
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function getProductsProperty()
    {
        if ($this->activeTab === 'wishlist') {
            // Use session-based wishlist for all users
            $wishlistService = app(\App\Services\WishlistService::class);
            $wishlistProducts = $wishlistService->getWishlistProducts();
            // Return as a paginator for compatibility
            $page = request()->get('page', 1);
            $perPage = $this->perPage;
            $items = $wishlistProducts->forPage($page, $perPage);
            return new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $wishlistProducts->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
        $query = Product::query()
            ->where('is_active', true)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('sku', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('slug', $this->category);
                });
            })
            ->when(!empty($this->selectedTags), function ($query) {
                $query->whereHas('tags', function ($query) {
                    $query->whereIn('tags.id', $this->selectedTags);
                });
            })
            ->when($this->activeTab === 'featured', function ($query) {
                $query->where('is_featured', true);
            })
            ->when($this->activeTab === 'new', function ($query) {
                $query->where('is_new', true);
            })
            ->when($this->activeTab === 'sale', function ($query) {
                $query->where('is_on_sale', true)
                    ->whereNotNull('sale_price')
                    ->where('sale_price', '>', 0);
            });
        // Apply sorting
        $query->orderBy($this->sortBy, $this->sortOrder);
        return $query->with(['category', 'images', 'tags'])->paginate($this->perPage);
    }

    public function render()
    {
        $categories = Category::all();
        $currentCategory = $this->category ? Category::where('slug', $this->category)->first() : null;
        // Get tags based on category selection
        $tagsQuery = Tag::query()->withCount([
            'products' => function ($query) {
                $query->where('is_active', true);
                if ($this->category) {
                    $query->whereHas('category', function ($q) {
                        $q->where('slug', $this->category);
                    });
                }
            }
        ]);
        $tags = $tagsQuery->get()->filter(function ($tag) {
            return $tag->products_count > 0;
        });
        $baseQuery = Product::where('is_active', true);
        if ($this->category) {
            $baseQuery->whereHas('category', function ($q) {
                $q->where('slug', $this->category);
            });
        }
        $wishlistService = app(\App\Services\WishlistService::class);
        $counts = [
            'all' => (clone $baseQuery)->count(),
            'featured' => (clone $baseQuery)->where('is_featured', true)->count(),
            'new' => (clone $baseQuery)->where('is_new', true)->count(),
            'sale' => (clone $baseQuery)
                ->where('is_on_sale', true)
                ->whereNotNull('sale_price')
                ->where('sale_price', '>', 0)
                ->count(),
            'wishlist' => $wishlistService->getWishlistProducts()->count(),
        ];
        return view('livewire.products', [
            'products' => $this->products,
            'categories' => $categories,
            'tags' => $tags,
            'currentCategory' => $currentCategory,
            'counts' => $counts,
        ]);
    }
}
