<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($faker));

        return [
            'category_id' => Category::inRandomOrder()->first()?->id, // Safe
            'name' => $name,
            'description' => $this->faker->paragraph(3),
            'brief_description' => $faker->markdown() ,
            'price' => $this->faker->randomFloat(2, 5, 500),
            'sale_price' => $this->faker->optional()->randomFloat(2, 1, 499),
            'stock' => $this->faker->numberBetween(0, 500),
            'sku' => strtoupper(Str::random(8)),
            'barcode' => $this->faker->ean13(),
            'weight' => $this->faker->optional()->randomFloat(2, 0.1, 10),
            'width' => $this->faker->optional()->randomFloat(2, 1, 100),
            'height' => $this->faker->optional()->randomFloat(2, 1, 100),
            'depth' => $this->faker->optional()->randomFloat(2, 1, 100),
            'is_active' => $this->faker->boolean(90),
            'is_featured' => $this->faker->boolean(30),
            'is_new' => $this->faker->boolean(40),
            'is_on_sale' => $this->faker->boolean(20),
            'sort' => $this->faker->numberBetween(1, 100),
        ];
    }
}
