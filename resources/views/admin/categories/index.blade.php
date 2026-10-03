<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Manage Categories</title>
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
                    Categories
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Manage product categories.
                </p>
            </div>

            <a
                href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-black px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-800"
            >
                + Add Category
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- CATEGORY LIST --}}
        <div class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white">

            @if ($categories->count())

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="border-b border-gray-200 bg-gray-50">

                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Image
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Category
                                </th>

                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Products
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Action
                                </th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach ($categories as $category)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- IMAGE --}}
                                    <td class="px-6 py-5">

                                        @if ($category->image)

                                            <img
                                                src="{{ asset('storage/' . $category->image) }}"
                                                alt="{{ $category->name }}"
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


                                    {{-- CATEGORY --}}
                                    <td class="px-6 py-5">

                                        <p class="font-semibold">
                                            {{ $category->name }}
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $category->description }}
                                        </p>

                                    </td>


                                    {{-- PRODUCTS --}}
                                    <td class="px-6 py-5">

                                        <span class="text-sm text-gray-600">
                                            {{ $category->products()->count() }} Products
                                        </span>

                                    </td>


                                    {{-- ACTION --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-end gap-3">

                                            <a
                                                href="{{ route('admin.categories.edit', $category) }}"
                                                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-gray-900 hover:text-gray-900"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('admin.categories.destroy', $category) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this category?')"
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
                        Belum ada kategori.
                    </p>

                    <a
                        href="{{ route('admin.categories.create') }}"
                        class="mt-5 inline-flex rounded-lg bg-black px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800"
                    >
                        Add Category
                    </a>

                </div>

            @endif

        </div>

    </div>

</body>
</html>