<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Manage Products</title>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <div class="min-h-screen">

        {{-- HEADER --}}
        <div class="border-b border-brand-yellow/60 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-8 lg:px-8">

                <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-brand-brown/60 transition hover:text-brand-green"
                        >
                            ← Back to Dashboard
                        </a>

                        <div class="mt-5">

                            <div class="mb-3 h-1 w-10 rounded-full bg-brand-yellow"></div>

                            <h1 class="text-3xl font-semibold tracking-tight text-brand-brown">
                                Products
                            </h1>

                            <p class="mt-2 text-sm text-gray-500">
                                Manage all products on your website.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('admin.products.create') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-brand-brown hover:shadow-md"
                    >
                        <span class="mr-2 text-lg leading-none">+</span>
                        Add Product
                    </a>

                </div>

            </div>
        </div>


        {{-- CONTENT --}}
        <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8">


            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))

                <div class="mb-6 flex items-center gap-3 rounded-xl border border-brand-green/20 bg-brand-green/5 px-5 py-4 text-sm text-brand-green">

                    <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-brand-green text-white">
                        ✓
                    </div>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- PRODUCT LIST --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- CARD HEADER --}}
                <div class="flex flex-col gap-2 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="font-semibold text-brand-brown">
                            All Products
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            {{ $products->count() }}
                            {{ $products->count() === 1 ? 'product' : 'products' }}
                            available
                        </p>

                    </div>

                </div>


                @if ($products->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-left">

                            <thead class="border-b border-gray-100 bg-gray-50/70">

                                <tr>

                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                                        Image
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                                        Product
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                                        Category
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                                        Price
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-400">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @foreach ($products as $product)

                                    <tr class="group transition duration-200 hover:bg-brand-yellow/5">


                                        {{-- IMAGE --}}
                                        <td class="px-6 py-5">

                                            @if ($product->image)

                                                <div class="h-16 w-24 overflow-hidden rounded-xl border border-gray-100 bg-brand-yellow/10">

                                                    <img
                                                        src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                                    >

                                                </div>

                                            @else

                                                <div class="flex h-16 w-24 items-center justify-center rounded-xl border border-dashed border-gray-200 bg-brand-yellow/10">

                                                    <span class="text-[10px] font-medium uppercase tracking-wider text-gray-400">
                                                        No Image
                                                    </span>

                                                </div>

                                            @endif

                                        </td>


                                        {{-- PRODUCT --}}
                                        <td class="px-6 py-5">

                                            <p class="font-semibold text-brand-brown">
                                                {{ $product->name }}
                                            </p>

                                            @if ($product->description)

                                                <p class="mt-1 max-w-xs truncate text-sm text-gray-500">
                                                    {{ $product->description }}
                                                </p>

                                            @else

                                                <p class="mt-1 text-sm italic text-gray-400">
                                                    No description
                                                </p>

                                            @endif

                                        </td>


                                        {{-- CATEGORY --}}
                                        <td class="px-6 py-5">

                                            <span class="inline-flex items-center rounded-full bg-brand-yellow/30 px-3 py-1 text-xs font-semibold text-brand-brown">
                                                {{ $product->category->name }}
                                            </span>

                                        </td>


                                        {{-- PRICE --}}
                                        <td class="px-6 py-5">

                                            @if ($product->price !== null)

                                                <span class="text-sm font-semibold text-brand-green">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </span>

                                            @else

                                                <span class="text-sm text-gray-400">
                                                    -
                                                </span>

                                            @endif

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-6 py-5">

                                            @if ($product->is_active)

                                                <span class="inline-flex items-center rounded-full bg-brand-green/10 px-3 py-1 text-xs font-semibold text-brand-green">

                                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-brand-green"></span>

                                                    Active

                                                </span>

                                            @else

                                                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500">

                                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                                    Inactive

                                                </span>

                                            @endif

                                        </td>


                                        {{-- ACTION --}}
                                        <td class="px-6 py-5">

                                            <div class="flex items-center justify-end gap-2">

                                                <a
                                                    href="{{ route('admin.products.edit', $product) }}"
                                                    class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-600 transition duration-200 hover:border-brand-green hover:text-brand-green"
                                                >
                                                    Edit
                                                </a>


                                                <form
                                                    action="{{ route('admin.products.destroy', $product) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this product?')"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="rounded-lg border border-red-100 px-4 py-2 text-sm font-medium text-red-500 transition duration-200 hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                                    >
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                @else

                    {{-- EMPTY STATE --}}
                    <div class="px-6 py-20 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-yellow/30 text-2xl text-brand-brown">
                            +
                        </div>

                        <h3 class="mt-5 font-semibold text-brand-brown">
                            No products yet
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Start by adding your first product to the catalog.
                        </p>

                        <a
                            href="{{ route('admin.products.create') }}"
                            class="mt-6 inline-flex rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-brand-brown"
                        >
                            Add Product
                        </a>

                    </div>

                @endif

            </div>

        </main>

    </div>

</body>

</html>