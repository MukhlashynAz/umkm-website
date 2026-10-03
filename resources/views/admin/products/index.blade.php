<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Manage Products</title>
</head>

<body class="bg-gray-50 text-gray-900">

    <div class="mx-auto max-w-7xl px-6 py-10 lg:px-8">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-sm font-medium text-gray-500 transition hover:text-gray-900"
                >
                    ← Back to Dashboard
                </a>

                <h1 class="mt-4 text-3xl font-bold">
                    Products
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Manage all products on your website.
                </p>

            </div>


            <a
                href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-black px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                + Add Product
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- PRODUCT LIST --}}
        <div class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white">

            @if ($products->count())

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="border-b border-gray-200 bg-gray-50">

                            <tr>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Image
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Product
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Category
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Price
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @foreach ($products as $product)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- IMAGE --}}
                                    <td class="px-6 py-5">

                                        @if ($product->image)

                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="h-16 w-24 rounded-lg object-cover"
                                            >

                                        @else

                                            <div class="flex h-16 w-24 items-center justify-center rounded-lg bg-gray-100">

                                                <span class="text-[10px] uppercase tracking-wider text-gray-400">
                                                    No Image
                                                </span>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- PRODUCT --}}
                                    <td class="px-6 py-5">

                                        <p class="font-semibold">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-1 max-w-xs truncate text-sm text-gray-500">
                                            {{ $product->description }}
                                        </p>

                                    </td>


                                    {{-- CATEGORY --}}
                                    <td class="px-6 py-5">

                                        <span class="text-sm text-gray-600">
                                            {{ $product->category->name }}
                                        </span>

                                    </td>


                                    {{-- PRICE --}}
                                    <td class="px-6 py-5">

                                        @if ($product->price !== null)

                                            <span class="text-sm font-medium">
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

                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Active
                                            </span>

                                        @else

                                            <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACTION --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-end gap-3">

                                            <a
                                                href="{{ route('admin.products.edit', $product) }}"
                                                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-gray-900 hover:text-gray-900"
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
                                                    class="rounded-lg border border-red-200 px-4 py-2 text-sm font-medium text-red-600 transition hover:border-red-500 hover:bg-red-50"
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

                <div class="px-6 py-16 text-center">

                    <p class="text-gray-500">
                        Belum ada product.
                    </p>

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="mt-5 inline-flex rounded-lg bg-black px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800"
                    >
                        Add Product
                    </a>

                </div>

            @endif

        </div>

    </div>

</body>
</html>