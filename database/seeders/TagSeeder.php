<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        // Create 30 random tags
        Tag::factory(30)->create();

        $products = Product::all();
        $tagIds = Tag::pluck('id')->all();

        foreach ($products as $product) {
            // Assign between 0 to 5 random tags to each product
            $randomTagIds = collect($tagIds)
                ->random(rand(0, 5))
                ->unique();

            $product->tags()->syncWithoutDetaching($randomTagIds);
        }
    }
}
