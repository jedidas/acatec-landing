<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Category 1',
                'image' => 'uploads/categories/image-1.jpg',
                'description' => 'Description',
            ],
            [
                'name' => 'Category 2',
                'image' => 'uploads/categories/image-2.jpg',
                'description' => 'Description',
            ],
            [
                'name' => 'Category 3',
                'image' => 'uploads/categories/image-3.jpg',
                'description' => 'Description',
            ],
            [
                'name' => 'Category 4',
                'image' => 'uploads/categories/image-4.jpg',
                'description' => 'Description',
            ],
            [
                'name' => 'Category 5',
                'image' => 'uploads/categories/image-5.jpg',
                'description' => 'Description',
            ],
            [
                'name' => 'Category 6',
                'image' => 'uploads/categories/image-6.jpg',
                'description' => 'Description',
            ],
        ];

        foreach ($categories as $key => $category) {
            $slug =  Str::of($category['name'])->slug('-');
            Category::create([
                'name' => $category['name'],
                'menu' => $category['name'],
                'image' => $category['image'],
                'slug' => $slug,
                'is_active' => true,
                'description' =>  $category['description'],
            ]);
        }
    }
}
