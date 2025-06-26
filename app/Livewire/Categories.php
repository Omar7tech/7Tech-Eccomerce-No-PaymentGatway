<?php

namespace App\Livewire;

use App\Models\Category;
use App\Settings\ContentSettings;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $categories = Category::query()->with('products')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy("sort", "asc")
            ->paginate(36);

        $content = ContentSettings::class;

        return view('livewire.categories', compact('categories', "content"));
    }
}
