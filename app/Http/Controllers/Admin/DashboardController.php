<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Category::count();

        $productCount = Product::count();

        $activeProductCount = Product::where('is_active', true)->count();

        $companyProfile = CompanyProfile::first();

        return view('admin.dashboard', compact(
            'categoryCount',
            'productCount',
            'activeProductCount',
            'companyProfile'
        ));
    }
}