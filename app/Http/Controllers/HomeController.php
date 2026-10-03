<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::first();
        $categories = Category::with('products')
            ->get();
        $products = Product::where('is_active', true)
            ->latest()
            ->get();

        return view('home', compact(
            'company',
            'categories',
            'products'
        ));
    }
}