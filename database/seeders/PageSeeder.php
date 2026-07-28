<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Page::STATIC_PAGES as $slug => $name) {
            Page::firstOrCreate([
                'slug' => $slug
            ], [
                'name' => $name
            ]);
        }
    }
}
