<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryProductController extends Controller
{
    public function index(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->with(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->firstOrFail();

        return view('categories.products', compact('category'));
    }
}