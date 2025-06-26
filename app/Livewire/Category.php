<?php

namespace App\Livewire;

use Livewire\Component;

class Category extends Component
{

    public \App\Models\Category $category;  
    public function render()
    {
        return view('livewire.category');
    }
}
