<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>
        {{ $category->name }}
        — Products
    </title>
</head>

@php
    $company = \App\Models\CompanyProfile::first();

    $whatsappNumber = $company?->phone
        ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $company->phone))
        : '6285381780108';
@endphp

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

                    <span class="text-lg font-bold tracking-tight text-gray-900">
                        {{ $company?->company_name ?? 'COMPANY' }}
                    </span>

                @endif

            </a>


            {{-- DESKTOP NAVIGATION --}}
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


            {{-- CONTACT --}}
            <a
                href="{{ route('home') }}#contact"
                class="rounded-full bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700"
            >
                Contact
            </a>

        </div>

    </nav>


    {{-- ========================================================= --}}
    {{-- CATEGORY HERO --}}
    {{-- ========================================================= --}}

    <section class="bg-gray-50">

        <div class="mx-auto max-w-7xl px-6 py-10 lg:px-8 lg:py-14">

            {{-- BREADCRUMB --}}
            <div class="mb-8 flex items-center gap-2 text-sm">

                <a
                    href="{{ route('categories.index') }}"
                    class="text-gray-400 transition hover:text-gray-900"
                >
                    Products
                </a>

                <span class="text-gray-300">
                    /
                </span>

                <span class="font-medium text-gray-700">
                    {{ $category->name }}
                </span>

            </div>


            {{-- HERO --}}
            <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm">

                <div class="grid lg:grid-cols-2">

                    {{-- CATEGORY IMAGE --}}
                    <div class="relative aspect-[4/3] overflow-hidden bg-gray-100 lg:aspect-auto lg:min-h-[420px]">

                        @if ($category->image)

                            <img
                                src="{{ asset('storage/' . $category->image) }}"
                                alt="{{ $category->name }}"
                                class="absolute inset-0 h-full w-full object-cover"
                            >

                        @else

                            <div class="flex h-full min-h-[320px] items-center justify-center">

                                <span class="text-xs font-medium uppercase tracking-[0.2em] text-gray-400">
                                    Category Image
                                </span>

                            </div>

                        @endif

                    </div>


                    {{-- CATEGORY INFORMATION --}}
                    <div class="flex flex-col justify-center px-8 py-12 sm:px-12 lg:px-16 lg:py-16">

                        <div class="flex items-center gap-3">

                            <span class="h-px w-10 bg-amber-500"></span>

                            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-600">
                                Product Category
                            </p>

                        </div>


                        <h1 class="mt-5 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                            {{ $category->name }}
                        </h1>


                        @if ($category->description)

                            <p class="mt-6 max-w-xl text-base leading-8 text-gray-600">
                                {{ $category->description }}
                            </p>

                        @endif


                        <div class="mt-8">

                            <span class="rounded-full border border-gray-200 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-600">

                                {{ $category->products->count() }}

                                {{ $category->products->count() === 1 ? 'Product' : 'Products' }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- PRODUCTS --}}
    {{-- ========================================================= --}}

    <main>

        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-28">

            {{-- HEADER --}}
            <div class="mb-10 flex items-end justify-between gap-6">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-gray-400">
                        Collection
                    </p>

                    <h2 class="mt-2 text-2xl font-bold tracking-tight">
                        Available Products
                    </h2>

                </div>


                <a
                    href="{{ route('categories.index') }}"
                    class="hidden text-sm font-semibold text-gray-900 transition hover:text-amber-600 sm:block"
                >
                    ← All Categories
                </a>

            </div>


            @if ($category->products->isNotEmpty())

                {{-- PRODUCT GRID --}}
                <div class="grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                    @foreach ($category->products as $product)

                        <a
                            href="{{ route('products.show', $product->slug) }}"
                            class="group"
                        >

                            {{-- PRODUCT IMAGE --}}
                            <div class="relative aspect-[4/5] overflow-hidden rounded-2xl bg-gray-100">

                                @if ($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
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


                                {{-- HOVER LABEL --}}
                                <div class="absolute inset-x-0 bottom-0 translate-y-full bg-gray-900/90 px-5 py-4 text-center transition duration-300 group-hover:translate-y-0">

                                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-white">
                                        View Product →
                                    </span>

                                </div>

                            </div>


                            {{-- PRODUCT INFORMATION --}}
                            <div class="pt-5">

                                <h3 class="text-lg font-semibold tracking-tight text-gray-900 transition group-hover:text-gray-600">
                                    {{ $product->name }}
                                </h3>


                                @if ($product->description)

                                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-500">
                                        {{ $product->description }}
                                    </p>

                                @endif


                                @if ($product->price !== null)

                                    <p class="mt-4 text-base font-bold text-gray-900">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                @else

                                    <p class="mt-4 text-sm font-medium text-gray-400">
                                        Contact for price
                                    </p>

                                @endif

                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                {{-- EMPTY STATE --}}
                <div class="rounded-2xl border border-dashed border-gray-300 px-6 py-24 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                        —
                    </div>

                    <h3 class="mt-5 text-lg font-semibold text-gray-900">
                        No products available
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        There are currently no active products in this category.
                    </p>

                    <a
                        href="{{ route('categories.index') }}"
                        class="mt-7 inline-flex rounded-full bg-gray-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-gray-700"
                    >
                        Browse Other Categories
                    </a>

                </div>

            @endif


            {{-- MOBILE BACK --}}
            <div class="mt-12 sm:hidden">

                <a
                    href="{{ route('categories.index') }}"
                    class="text-sm font-semibold text-gray-900"
                >
                    ← All Categories
                </a>

            </div>

        </div>

    </main>


    {{-- ========================================================= --}}
    {{-- CONTACT CTA --}}
    {{-- ========================================================= --}}

    <section class="bg-gray-50">

        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">

            <div class="flex flex-col items-start justify-between gap-8 rounded-[2rem] bg-gray-900 px-8 py-12 sm:px-12 lg:flex-row lg:items-center lg:px-16">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-400">
                        Need More Information?
                    </p>

                    <h2 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Interested in our products?
                    </h2>

                    <p class="mt-4 max-w-xl text-sm leading-7 text-gray-400">
                        Contact us for more information, availability, and product details.
                    </p>

                </div>


                <a
                    href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo, saya ingin mendapatkan informasi mengenai produk kategori ' . $category->name . '.') }}"
                    target="_blank"
                    class="shrink-0 rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-gray-900 transition hover:bg-gray-100"
                >
                    Contact Us →
                </a>

            </div>

        </div>

    </section>


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


    {{-- ========================================================= --}}
    {{-- FLOATING WHATSAPP --}}
    {{-- ========================================================= --}}

    <a
        href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo, saya ingin mendapatkan informasi mengenai produk ' . ($company?->company_name ?? 'perusahaan') . '.') }}"
        target="_blank"
        aria-label="Chat via WhatsApp"
        class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white shadow-lg transition duration-300 hover:scale-110 hover:bg-green-600"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-7 w-7"
        >
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.67.15-.197.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.099-.149.05-.372-.025-.52-.075-.149-.669-1.611-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.372.074-.57.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.849 1.213 3.047.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.987 2.896a9.825 9.825 0 012.893 6.99c-.003 5.45-4.44 9.885-9.888 9.89m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.89c0 2.096.547 4.143 1.588 5.945L.057 24l6.304-1.654a11.89 11.89 0 005.684 1.447h.005c6.554 0 11.89-5.335 11.893-11.89a11.84 11.84 0 00-3.479-8.415"/>
        </svg>

    </a>

</body>

</html>