<?php

namespace App\Livewire\Parts;

use App\Models\Product;
use Livewire\Component;

class NewProductsHome extends Component
{
    public function render()
    {
        $products = Product::limit(15)->where("is_new" , true)->get();
        return view('livewire.parts.new-products-home' , compact('products'));
    }
}