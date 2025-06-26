<?php

namespace App\Livewire\Parts;

use App\Models\Product;
use Livewire\Component;

class FeaturedProductsHome extends Component
{
    public function render()
    {
        $products = Product::limit(10)->where("is_featured" , true)->get();
        return view('livewire.parts.featured-products-home' , compact('products'));
    }
}