<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            //'subcategory_id' => SubCategory::factory(),
            'brand_id' => Brand::factory(),
            'product_name' => $this->faker->title,
            'product_slug' => $this->faker->name,
            'product_sku' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'product_price' => $this->faker->randomDigit,
            'product_thambnail' => $this->faker->imageUrl($width = 400, $height = 300),
        ];
    }
}
