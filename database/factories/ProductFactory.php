<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $nameLength = fake()->numberBetween(30, 60);
        $name = fake()->text($nameLength);

        return [
            'name' => $name,
            'slug' => Str::of($name)->slug('-'),
            'category_id' => fake()->numberBetween(1, 6),
            'image' => fake()->randomElement([
                'uploads/products/image-1.jpg',
                'uploads/products/image-2.jpg',
                'uploads/products/image-3.jpg',
                'uploads/products/image-4.jpg',
                'uploads/products/image-5.jpg',
                'uploads/products/image-6.jpg',
                'uploads/products/image-7.jpg',
                'uploads/products/image-8.jpg',
                'uploads/products/image-9.jpg',
                'uploads/products/image-10.jpg',
                'uploads/products/image-11.jpg',
                'uploads/products/image-12.jpg',
                'uploads/products/image-13.jpg',
                'uploads/products/image-14.jpg',
                'uploads/products/image-15.jpg',
                'uploads/products/image-16.jpg',
                'uploads/products/image-17.jpg',
            ]),
            'price' => fake()->boolean() ? fake()->numberBetween(10000, 850000) : 0,
            'discount' =>  fake()->numberBetween(0, 25),
            'code' => fake()->boolean() ? uniqid() : null,
            'description' => fake()->text(890),
            'is_active' => fake()->boolean(),
            'is_featured' => fake()->boolean(),
            'has_price' => fake()->boolean(),
            'added_on' => now()
        ];
    }
}
