<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $company = CompanyProfile::first();

        return view('products.show', compact(
            'product',
            'company'
        ));
    }
}