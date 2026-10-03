<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Product Categories{{ $company?->company_name ? ' — ' . $company->company_name : '' }}</title>
</head>

<body class="bg-white text-gray-900 antialiased">

    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <nav class="sticky top-0 z-50 border-b border-gray-100 bg-white/95 backdrop-blur">

        <div class="mx-auto flex h-[72px] max-w-7xl items-center justify-between px-5 lg:px-8">

            {{-- LOGO --}}
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3"
            >

                @if ($company?->logo)

                    <img
                        src="{{ asset('storage/' . $company->logo) }}"
                        alt="{{ $company->company_name ?? 'Company Logo' }}"
                        class="h-10 w-auto object-contain"
                    >

                @else

                    <span class="text-lg font-bold tracking-tight">
                        {{ $company?->company_name ?? 'COMPANY' }}
                    </span>

                @endif

            </a>


            {{-- NAVIGATION --}}
            <div class="hidden items-center gap-8 md:flex">

                <a
                    href="{{ route('home') }}"
                    class="text-sm font-medium text-gray-500 transition hover:text-gray-900"
                >
                    Home
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="text-sm font-semibold text-gray-900"
                >
                    Products
                </a>

                <a
                    href="{{ route('home') }}#about"
                    class="text-sm font-medium text-gray-500 transition hover:text-gray-900"
                >
                    About
                </a>

                <a
                    href="{{ route('home') }}#contact"
                    class="text-sm font-medium text-gray-500 transition hover:text-gray-900"
                >
                    Contact
                </a>

            </div>


            {{-- ACTION --}}
            <a
                href="{{ route('home') }}#contact"
                class="rounded-full bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700"
            >
                Contact
            </a>

        </div>

    </nav>


    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <section class="bg-gray-50">

        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-24">

            <div class="max-w-3xl">

                <div class="flex items-center gap-3">

                    <span class="h-px w-10 bg-amber-500"></span>

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-600">
                        Product Catalog
                    </p>

                </div>


                <h1 class="mt-5 text-5xl font-bold tracking-tight sm:text-6xl">
                    Explore Our
                    <span class="text-gray-400">
                        Products.
                    </span>
                </h1>


                <p class="mt-6 max-w-2xl text-base leading-8 text-gray-600 sm:text-lg">
                    Browse our products by category and discover the solutions
                    that best fit your needs.
                </p>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- CATEGORY LIST --}}
    {{-- ========================================================= --}}

    <main>

        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-28">

            <div class="mb-10 flex items-end justify-between gap-6">

                <div>

                    <p class="text-sm font-medium text-gray-400">
                        {{ $categories->count() }}
                        {{ $categories->count() === 1 ? 'Category' : 'Categories' }}
                    </p>

                    <h2 class="mt-2 text-2xl font-bold tracking-tight">
                        Browse Categories
                    </h2>

                </div>

            </div>


            @if ($categories->isNotEmpty())

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($categories as $category)

                        <a
                            href="{{ route('categories.products', $category->slug) }}"
                            class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-gray-300 hover:shadow-xl"
                        >

                            {{-- IMAGE --}}
                            <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">

                                @if ($category->image)

                                    <img
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                    >

                                @else

                                    <div class="flex h-full w-full items-center justify-center">

                                        <div class="text-center">

                                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-white text-gray-300 shadow-sm">
                                                →
                                            </div>

                                            <p class="mt-3 text-xs font-medium uppercase tracking-wider text-gray-400">
                                                No Image
                                            </p>

                                        </div>

                                    </div>

                                @endif


                                {{-- PRODUCT COUNT --}}
                                <div class="absolute bottom-4 left-4">

                                    <span class="rounded-full bg-white/95 px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-sm backdrop-blur">

                                        {{ $category->products->count() }}
                                        {{ $category->products->count() === 1 ? 'Product' : 'Products' }}

                                    </span>

                                </div>

                            </div>


                            {{-- INFORMATION --}}
                            <div class="p-6">

                                <div class="flex items-start justify-between gap-5">

                                    <div class="min-w-0">

                                        <h3 class="text-xl font-semibold tracking-tight text-gray-900">
                                            {{ $category->name }}
                                        </h3>


                                        @if ($category->description)

                                            <p class="mt-3 line-clamp-2 text-sm leading-6 text-gray-500">
                                                {{ $category->description }}
                                            </p>

                                        @else

                                            <p class="mt-3 text-sm leading-6 text-gray-400">
                                                Explore products in this category.
                                            </p>

                                        @endif

                                    </div>


                                    <span class="mt-1 shrink-0 text-xl text-gray-400 transition duration-300 group-hover:translate-x-1 group-hover:text-gray-900">
                                        →
                                    </span>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                {{-- EMPTY STATE --}}

                <div class="rounded-2xl border border-dashed border-gray-300 px-6 py-20 text-center">

                    <p class="text-sm font-medium text-gray-500">
                        No product categories available yet.
                    </p>

                    <p class="mt-2 text-sm text-gray-400">
                        Please check back later.
                    </p>

                </div>

            @endif

        </div>

    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="border-t border-gray-100 bg-white">

        <div class="mx-auto flex max-w-7xl flex-col gap-5 px-6 py-8 sm:flex-row sm:items-center sm:justify-between lg:px-8">

            <div class="flex items-center gap-3">

                @if ($company?->logo)

                    <img
                        src="{{ asset('storage/' . $company->logo) }}"
                        alt="{{ $company->company_name ?? 'Company Logo' }}"
                        class="h-8 w-auto object-contain"
                    >

                @endif

                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }}
                    {{ $company?->company_name ?? 'Company' }}.
                    All rights reserved.
                </p>

            </div>


            <a
                href="{{ route('login') }}"
                class="text-xs font-medium text-gray-400 transition hover:text-gray-900"
            >
                Admin
            </a>

        </div>

    </footer>

</body>

</html>