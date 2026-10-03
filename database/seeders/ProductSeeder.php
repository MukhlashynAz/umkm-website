<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category1 = Category::where('slug', 'kategori-1')->first();
        $category2 = Category::where('slug', 'kategori-2')->first();

        Product::create([
            'category_id' => $category1->id,
            'name' => 'Produk 1',
            'slug' => 'produk-1',
            'description' => 'Deskripsi produk pertama.',
            'specifications' => 'Spesifikasi produk pertama.',
            'image' => null,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $category2->id,
            'name' => 'Produk 2',
            'slug' => 'produk-2',
            'description' => 'Deskripsi produk kedua.',
            'specifications' => 'Spesifikasi produk kedua.',
            'image' => null,
            'is_active' => true,
        ]);
    }
}