<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyProfile;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')
            ->latest()
            ->get();

        $company = CompanyProfile::first();

        return view('categories.index', compact(
            'categories',
            'company'
        ));
    }
}