<?php
namespace App\Livewire\Parts;

use App\Models\Product;
use Livewire\Component;

class ProductsHome extends Component
{
    public string $type = 'featured'; // default

    public function render()
    {
        $query = Product::query();

        switch ($this->type) {
            case 'new':
                $query->where('is_new', true);
                break;
            case 'sale':
                $query->has('sale_price');
                break;
            case 'featured':
            default:
                $query->where('is_featured', true);
                break;
        }

        $products = $query->inRandomOrder()->limit(4)->get();

        return view('livewire.parts.products-home', compact('products'));
    }
}
