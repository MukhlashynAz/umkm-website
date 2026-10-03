<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Edit Product</title>
</head>

<body class="bg-gray-50 text-gray-900">

    <div class="mx-auto max-w-3xl px-6 py-10">

        {{-- BACK --}}
        <a
            href="{{ route('admin.products.index') }}"
            class="inline-flex items-center text-sm font-medium text-gray-500 transition hover:text-gray-900"
        >
            ← Back to Products
        </a>


        {{-- HEADER --}}
        <h1 class="mt-6 text-3xl font-bold">
            Edit Product
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Update the product information and image.
        </p>


        {{-- FORM --}}
        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
            class="mt-8 space-y-6 rounded-2xl border border-gray-200 bg-white p-8"
        >

            @csrf
            @method('PUT')


            {{-- CATEGORY --}}
            <div>

                <label class="text-sm font-semibold">
                    Category
                </label>

                <select
                    name="category_id"
                    required
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-white px-4 py-3 outline-none transition focus:border-black"
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

                <label class="text-sm font-semibold">
                    Product Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    required
                    class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
                >

                @error('name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- DESCRIPTION --}}
            <div>

                <label class="text-sm font-semibold">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
                >{{ old('description', $product->description) }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- PRICE --}}
            <div>

                <label class="text-sm font-semibold">
                    Price
                </label>

                <div class="mt-2 flex">

                    <span class="inline-flex items-center rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 px-4 text-sm text-gray-500">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        min="0"
                        step="0.01"
                        class="w-full rounded-r-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
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

                <label class="text-sm font-semibold">
                    Product Image
                </label>


                {{-- CURRENT IMAGE --}}
                @if ($product->image)

                    <div class="mt-3">

                        <p class="mb-2 text-xs font-medium uppercase tracking-wider text-gray-400">
                            Current Image
                        </p>

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="h-48 w-full rounded-xl object-cover"
                        >

                    </div>

                @else

                    <div class="mt-3 flex h-48 w-full items-center justify-center rounded-xl bg-gray-100">

                        <span class="text-xs font-medium uppercase tracking-wider text-gray-400">
                            No Image
                        </span>

                    </div>

                @endif


                {{-- NEW IMAGE --}}
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="mt-3 block w-full rounded-lg border border-gray-300 px-4 py-3 text-sm"
                >

                <p class="mt-2 text-xs text-gray-500">
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
            <div>

                <label class="inline-flex cursor-pointer items-center gap-3">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300"
                    >

                    <span class="text-sm font-semibold">
                        Active Product
                    </span>

                </label>

                <p class="mt-2 text-xs text-gray-500">
                    Product aktif akan ditampilkan di website.
                </p>

            </div>


            {{-- ACTIONS --}}
            <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="rounded-lg border border-gray-300 px-5 py-3 text-center text-sm font-semibold text-gray-700 transition hover:border-gray-900 hover:text-gray-900"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-black px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</body>
</html>