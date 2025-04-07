<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\UploadFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlbumProduct>
 */
class AlbumProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pro_id' => Product::all()->random()->id,
            'upl_id' => UploadFile::all()->random()->id,
            'type' => $this->faker->randomElement(['mainImage', 'none']),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
