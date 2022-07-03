<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::create(['name' => 'First category']);
        $category->slugs()->create([
            'locale' => 'en',
            'slug' => 'first-category'
        ]);

        $category = Category::create(['name' => 'Second category']);
        $category->slugs()->create([
            'locale' => 'en',
            'slug' => 'second-category'
        ]);
        $category->slugs()->create([
            'locale' => 'lt',
            'slug' => 'antra-kategorija'
        ]);

        Category::create(['name' => 'Non-slug category']);

        $category = Category::create(['name' => 'Third category']);
        $category->slugs()->create([
            'locale' => 'en',
            'slug' => 'third-category'
        ]);
        $category->slugs()->create([
            'locale' => 'lt',
            'slug' => 'trecia-kategorija'
        ]);
    }
}
