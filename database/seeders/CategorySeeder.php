<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Kategori 1',
            'slug' => 'kategori-1',
            'description' => 'Deskripsi kategori produk.',
        ]);

        Category::create([
            'name' => 'Kategori 2',
            'slug' => 'kategori-2',
            'description' => 'Deskripsi kategori produk.',
        ]);
    }
}