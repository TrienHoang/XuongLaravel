<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\UploadFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'quantity' => $this->faker->randomNumber(2),
            'category_id' => Category::all()->random()->id,
            'brand_id' =>  Brand::all()->random()->id,
            'image' => UploadFile::all()->random()->id,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
