<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->latest()
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $category->image = $request->file('image')
                ->store('categories', 'public');
        }

        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category berhasil ditambahkan.');
    }

    public function show(Category $category)
    {
        return redirect()
            ->route('admin.categories.edit', $category);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            // Simpan gambar baru
            $category->image = $request->file('image')
                ->store('categories', 'public');
        }

        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        // Hapus gambar category jika ada
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category berhasil dihapus.');
    }
}