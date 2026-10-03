<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $product = new Product();

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')
                ->store('products', 'public');
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return redirect()
            ->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Simpan gambar baru
            $product->image = $request->file('image')
                ->store('products', 'public');
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar product jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product berhasil dihapus.');
    }
}