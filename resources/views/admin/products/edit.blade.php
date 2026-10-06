<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Edit Product</title>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <div class="min-h-screen">

        {{-- HEADER --}}
        <div class="border-b border-brand-yellow/60 bg-white">
            <div class="mx-auto max-w-3xl px-6 py-8 lg:px-8">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="inline-flex items-center text-sm font-medium text-brand-brown/60 transition hover:text-brand-green"
                >
                    ← Back to Products
                </a>

                <div class="mt-5">
                    <div class="mb-3 h-1 w-10 rounded-full bg-brand-yellow"></div>

                    <h1 class="text-3xl font-semibold tracking-tight text-brand-brown">
                        Edit Product
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Update the product information and image.
                    </p>
                </div>

            </div>
        </div>


        {{-- CONTENT --}}
        <main class="mx-auto max-w-3xl px-6 py-8 lg:px-8">

            <form
                action="{{ route('admin.products.update', $product) }}"
                method="POST"
                enctype="multipart/form-data"
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >

                @csrf
                @method('PUT')


                {{-- FORM HEADER --}}
                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <h2 class="font-semibold text-brand-brown">
                        Product Information
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Update the product details below.
                    </p>

                </div>


                <div class="space-y-7 px-6 py-7 sm:px-8">


                    {{-- CATEGORY --}}
                    <div>

                        <label
                            for="category_id"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Category
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            required
                            class="mt-2 w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                        >

                            <option value="">
                                Select Category
                            </option>

                            @foreach ($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- PRODUCT NAME --}}
                    <div>

                        <label
                            for="name"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Product Name
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name', $product->name) }}"
                            required
                            class="mt-2 w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}
                    <div>

                        <label
                            for="description"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="mt-2 w-full resize-none rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- PRICE --}}
                    <div>

                        <label
                            for="price"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Price
                        </label>

                        <div class="mt-2 flex">

                            <span class="inline-flex items-center rounded-l-xl border border-r-0 border-gray-300 bg-brand-yellow/20 px-4 text-sm font-semibold text-brand-brown">
                                Rp
                            </span>

                            <input
                                id="price"
                                type="number"
                                name="price"
                                value="{{ old('price', $product->price) }}"
                                min="0"
                                step="0.01"
                                class="w-full rounded-r-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                            >

                        </div>

                        @error('price')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- PRODUCT IMAGE --}}
                    <div>

                        <label
                            for="image"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Product Image
                        </label>


                        {{-- CURRENT IMAGE --}}
                        @if ($product->image)

                            <div class="mt-3">

                                <div class="mb-2 flex items-center justify-between">

                                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                                        Current Image
                                    </p>

                                    <span class="rounded-full bg-brand-yellow/30 px-3 py-1 text-[10px] font-semibold uppercase tracking-wider text-brand-brown">
                                        Existing
                                    </span>

                                </div>

                                <div class="overflow-hidden rounded-2xl border border-gray-100 bg-brand-yellow/10">

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-52 w-full object-cover"
                                    >

                                </div>

                            </div>

                        @else

                            <div class="mt-3 flex h-52 w-full items-center justify-center rounded-2xl border border-dashed border-gray-200 bg-brand-yellow/10">

                                <div class="text-center">

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-brand-yellow/40 text-xl text-brand-brown">
                                        +
                                    </div>

                                    <span class="mt-3 block text-xs font-medium uppercase tracking-wider text-gray-400">
                                        No Image
                                    </span>

                                </div>

                            </div>

                        @endif


                        {{-- NEW IMAGE --}}
                        <input
                            id="image"
                            type="file"
                            name="image"
                            accept="image/*"
                            class="mt-4 block w-full cursor-pointer rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-600 transition file:mr-4 file:rounded-lg file:border-0 file:bg-brand-green file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-brand-brown focus:border-brand-green focus:outline-none"
                        >

                        <p class="mt-2 text-xs leading-relaxed text-gray-500">
                            Upload gambar baru jika ingin mengganti gambar lama.
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2MB.
                        </p>

                        @error('image')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- STATUS --}}
                    <div class="rounded-xl border border-gray-100 bg-gray-50 px-5 py-4">

                        <label class="inline-flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-brand-green focus:ring-brand-green"
                            >

                            <span class="text-sm font-semibold text-brand-brown">
                                Active Product
                            </span>

                        </label>

                        <p class="mt-2 pl-7 text-xs text-gray-500">
                            Product aktif akan ditampilkan di website.
                        </p>

                    </div>


                </div>


                {{-- ACTIONS --}}
                <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50/60 px-6 py-5 sm:flex-row sm:justify-end sm:px-8">

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="rounded-xl border border-gray-300 bg-white px-5 py-3 text-center text-sm font-semibold text-gray-600 transition duration-200 hover:border-brand-green hover:text-brand-green"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-brand-brown hover:shadow-md"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </main>

    </div>

</body>

</html>