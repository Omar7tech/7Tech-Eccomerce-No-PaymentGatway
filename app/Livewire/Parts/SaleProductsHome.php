<?php

namespace App\Livewire\Parts;

use App\Models\Product;
use Livewire\Component;

class SaleProductsHome extends Component
{
    public function render()
    {
        $products = Product::where("is_on_sale", true)
            ->whereNotNull('sale_price')
            ->where('sale_price', '>', 0)
            ->limit(10)
            ->get();
        return view('livewire.parts.sale-products-home', compact("products"));
    }
}