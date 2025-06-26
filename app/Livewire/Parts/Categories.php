<?php

namespace App\Livewire\Parts;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Url;

class Categories extends Component
{
    public bool $showAll = false;
    #[Url]
    public string $search = '';

    public function toggleShowAll()
    {
        $this->showAll = !$this->showAll;
    }

    public function render()
    {
        $categories = Category::query()->whereHas('products')->with('products')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy("sort", "asc")
            ->limit($this->showAll ? 100 : 6)
            ->get();

        return view('livewire.parts.categories', compact('categories'));
    }
}
