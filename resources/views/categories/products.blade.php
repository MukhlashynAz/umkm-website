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

    <x-favicon />

</head>

@php
    $company = \App\Models\CompanyProfile::first();

    $whatsappNumber = $company?->phone
        ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $company->phone))
        : '';

    $whatsappCategoryMessage =
        'Halo, saya ingin mendapatkan informasi mengenai produk kategori ' .
        $category->name .
        '.';
@endphp


<body class="bg-white text-gray-900 antialiased">


{{-- ========================================================= --}}
{{-- NAVBAR --}}
{{-- ========================================================= --}}

<nav class="sticky top-0 z-50 border-b border-brand-yellow/60 bg-white/95 backdrop-blur">

    <div class="mx-auto flex h-[72px] max-w-7xl items-center justify-between px-5 lg:px-8">

        {{-- LOGO + COMPANY NAME --}}
        <a
            href="{{ route('home') }}"
            class="flex min-w-0 items-center gap-3"
        >

            @if ($company?->logo)

                <img
                    src="{{ asset('storage/' . $company->logo) }}"
                    alt="{{ $company->company_name ?? 'Company Logo' }}"
                    class="h-10 w-10 shrink-0 rounded-lg object-contain"
                >

            @endif

            <span class="truncate text-sm font-bold tracking-tight text-brand-brown sm:text-base">
                {{ $company?->company_name ?? 'COMPANY' }}
            </span>

        </a>


        {{-- DESKTOP NAVIGATION --}}
        <div class="hidden items-center gap-8 md:flex">

            <a
                href="{{ route('home') }}"
                class="text-sm font-medium text-gray-600 transition hover:text-brand-green"
            >
                Home
            </a>

            <a
                href="{{ route('categories.index') }}"
                class="text-sm font-semibold text-brand-green"
            >
                Products
            </a>

            <a
                href="{{ route('about') }}"
                class="text-sm font-medium text-gray-600 transition hover:text-brand-green"
            >
                About
            </a>

            <a
                href="{{ route('home') }}#contact"
                class="text-sm font-medium text-gray-600 transition hover:text-brand-green"
            >
                Contact
            </a>

        </div>


        {{-- DESKTOP ACTION --}}
        <div class="hidden items-center gap-3 md:flex">

            <a
                href="{{ route('login') }}"
                class="text-sm font-medium text-brand-brown transition hover:text-brand-green"
            >
                Admin
            </a>

            <a
                href="{{ route('home') }}#contact"
                class="rounded-full bg-brand-green px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-brown"
            >
                Contact
            </a>

        </div>


        {{-- MOBILE MENU BUTTON --}}
        <button
            type="button"
            id="mobile-menu-button"
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-gray-200 text-brand-green transition hover:bg-brand-yellow md:hidden"
            aria-label="Open menu"
            aria-expanded="false"
        >

            <svg
                id="mobile-menu-open-icon"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="h-5 w-5"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"
                />
            </svg>


            <svg
                id="mobile-menu-close-icon"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="hidden h-5 w-5"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>

        </button>

    </div>


    {{-- MOBILE MENU --}}
    <div
        id="mobile-menu"
        class="hidden border-t border-gray-100 bg-white md:hidden"
    >

        <div class="px-5 py-4">

            <div class="flex flex-col">

                <a
                    href="{{ route('home') }}"
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-medium text-gray-700 transition hover:text-brand-green"
                >
                    Home
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-semibold text-brand-green"
                >
                    Products
                </a>

                <a
                    href="{{ route('about') }}"
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-medium text-gray-700 transition hover:text-brand-green"
                >
                    About
                </a>

                <a
                    href="{{ route('home') }}#contact"
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-medium text-gray-700 transition hover:text-brand-green"
                >
                    Contact
                </a>

                <a
                    href="{{ route('login') }}"
                    class="mobile-menu-link mt-4 flex items-center justify-center rounded-full bg-brand-green px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-brown"
                >
                    Admin
                </a>

            </div>

        </div>

    </div>

</nav>


{{-- ========================================================= --}}
{{-- MOBILE NAVBAR SCRIPT --}}
{{-- ========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const button = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    const openIcon = document.getElementById('mobile-menu-open-icon');
    const closeIcon = document.getElementById('mobile-menu-close-icon');

    const links = document.querySelectorAll('.mobile-menu-link');

    if (!button || !menu) {
        return;
    }

    button.addEventListener('click', function () {

        const isOpen =
            button.getAttribute('aria-expanded') === 'true';

        if (isOpen) {

            menu.classList.add('hidden');

            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');

            button.setAttribute('aria-expanded', 'false');
            button.setAttribute('aria-label', 'Open menu');

        } else {

            menu.classList.remove('hidden');

            openIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');

            button.setAttribute('aria-expanded', 'true');
            button.setAttribute('aria-label', 'Close menu');

        }

    });


    links.forEach(function (link) {

        link.addEventListener('click', function () {

            menu.classList.add('hidden');

            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');

            button.setAttribute('aria-expanded', 'false');
            button.setAttribute('aria-label', 'Open menu');

        });

    });

});
</script>


{{-- ========================================================= --}}
{{-- CATEGORY HERO --}}
{{-- ========================================================= --}}

<section class="bg-brand-yellow/20">

    <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8 lg:py-16">

        {{-- BREADCRUMB --}}
        <div class="mb-8 flex items-center gap-2 text-xs sm:text-sm">

            <a
                href="{{ route('categories.index') }}"
                class="font-medium text-brand-green transition hover:text-brand-brown"
            >
                Products
            </a>

            <span class="text-brand-brown/30">
                /
            </span>

            <span class="font-medium text-brand-brown/70">
                {{ $category->name }}
            </span>

        </div>


        <div class="grid items-center gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:gap-14">

            {{-- LEFT --}}
            <div>

                <div class="flex items-center gap-3">

                    <span class="h-1 w-8 rounded-full bg-brand-green"></span>

                    <p class="text-[11px] font-semibold uppercase tracking-[0.3em] text-brand-green">
                        Product Category
                    </p>

                </div>


                <h1 class="mt-4 text-3xl font-bold leading-tight tracking-tight text-brand-brown sm:text-4xl lg:text-5xl">
                    {{ $category->name }}
                </h1>


                @if ($category->description)

                    <p class="mt-5 max-w-2xl text-sm leading-7 text-brand-brown/70 sm:text-base">
                        {{ $category->description }}
                    </p>

                @endif


                <div class="mt-6">

                    <span class="inline-flex rounded-full bg-white px-4 py-2 text-xs font-semibold text-brand-brown shadow-sm">

                        {{ $category->products->count() }}

                        {{ $category->products->count() === 1 ? 'Product' : 'Products' }}

                    </span>

                </div>

            </div>


            {{-- RIGHT --}}
            <div>

                <div class="relative aspect-[4/3] overflow-hidden rounded-[2rem] border border-brand-yellow/50 bg-white shadow-sm">

                    @if ($category->image)

                        <img
                            src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            class="h-full w-full object-cover transition duration-700 hover:scale-105"
                        >

                    @else

                        <div class="flex h-full w-full items-center justify-center bg-brand-yellow/10">

                            <div class="text-center">

                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-brand-yellow text-brand-brown">
                                    →
                                </div>

                                <p class="mt-3 text-xs font-semibold uppercase tracking-[0.2em] text-brand-brown/50">
                                    Category Image
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- PRODUCTS --}}
{{-- ========================================================= --}}

<main>

    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">

        {{-- HEADER --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

            <div>

                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-green">
                    Collection
                </p>

                <h2 class="mt-3 text-2xl font-bold tracking-tight text-brand-brown sm:text-3xl">
                    Available Products
                </h2>

            </div>


            <a
                href="{{ route('categories.index') }}"
                class="text-sm font-semibold text-brand-green transition hover:text-brand-brown"
            >
                ← All Categories
            </a>

        </div>


        @if ($category->products->isNotEmpty())

            {{-- PRODUCT GRID --}}
            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach ($category->products as $product)

                    <a
                        href="{{ route('products.show', $product->slug) }}"
                        class="group overflow-hidden rounded-2xl border border-brand-brown/10 bg-white transition duration-300 hover:-translate-y-1 hover:border-brand-green/30 hover:shadow-xl"
                    >

                        {{-- IMAGE --}}
                        <div class="relative aspect-[4/5] overflow-hidden bg-brand-yellow/10">

                            @if ($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                >

                            @else

                                <div class="flex h-full w-full items-center justify-center">

                                    <div class="text-center">

                                        <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-brand-yellow text-brand-brown">
                                            →
                                        </div>

                                        <p class="mt-3 text-[11px] font-medium uppercase tracking-wider text-brand-brown/50">
                                            No Image
                                        </p>

                                    </div>

                                </div>

                            @endif


                            {{-- HOVER LABEL --}}
                            <div class="absolute inset-x-0 bottom-0 translate-y-full bg-brand-brown/95 px-5 py-4 text-center transition duration-300 group-hover:translate-y-0">

                                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-white">
                                    View Product →
                                </span>

                            </div>

                        </div>


                        {{-- INFORMATION --}}
                        <div class="p-5">

                            <h3 class="text-lg font-semibold tracking-tight text-brand-brown transition group-hover:text-brand-green">
                                {{ $product->name }}
                            </h3>


                            @if ($product->description)

                                <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-500">
                                    {{ $product->description }}
                                </p>

                            @endif


                            @if ($product->price !== null)

                                <p class="mt-4 text-base font-bold text-brand-green">
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
            <div class="mt-10 rounded-2xl border border-dashed border-brand-green/30 bg-brand-yellow/10 px-6 py-20 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-brand-yellow text-brand-brown">
                    —
                </div>

                <h3 class="mt-5 text-lg font-semibold text-brand-brown">
                    No products available
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                    There are currently no active products in this category.
                </p>

                <a
                    href="{{ route('categories.index') }}"
                    class="mt-7 inline-flex rounded-full bg-brand-green px-6 py-3 text-sm font-semibold text-white transition hover:bg-brand-brown"
                >
                    Browse Other Categories
                </a>

            </div>

        @endif

    </div>

</main>


{{-- ========================================================= --}}
{{-- CONTACT CTA --}}
{{-- ========================================================= --}}

<section class="bg-brand-yellow/20">

    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">

        <div class="flex flex-col items-start justify-between gap-8 rounded-[2rem] bg-brand-green px-8 py-12 sm:px-12 lg:flex-row lg:items-center lg:px-16">

            <div>

                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-yellow">
                    Need More Information?
                </p>

                <h2 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Interested in our products?
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/75">
                    Contact us for more information, availability, and product details.
                </p>

            </div>


            @if ($whatsappNumber)

                <a
                    href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappCategoryMessage) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="shrink-0 rounded-full bg-brand-yellow px-7 py-3.5 text-sm font-semibold text-brand-brown transition hover:bg-white"
                >
                    Contact Us →
                </a>

            @endif

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer class="border-t border-brand-yellow/60 bg-white">

    <div class="mx-auto flex max-w-7xl flex-col gap-5 px-6 py-8 sm:flex-row sm:items-center sm:justify-between lg:px-8">

        <div class="flex items-center gap-3">

            @if ($company?->logo)

                <img
                    src="{{ asset('storage/' . $company->logo) }}"
                    alt="{{ $company->company_name ?? 'Company Logo' }}"
                    class="h-8 w-auto object-contain"
                >

            @endif

            <p class="text-xs text-brand-brown/60">
                &copy; {{ date('Y') }}
                {{ $company?->company_name ?? 'Company' }}.
                All rights reserved.
            </p>

        </div>


        <a
            href="{{ route('login') }}"
            class="text-xs font-medium text-brand-brown/60 transition hover:text-brand-green"
        >
            Admin
        </a>

    </div>

</footer>


{{-- ========================================================= --}}
{{-- FLOATING WHATSAPP --}}
{{-- ========================================================= --}}

@if ($whatsappNumber)

    <a
        href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo, saya ingin mendapatkan informasi mengenai produk ' . ($company?->company_name ?? 'perusahaan') . '.') }}"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat via WhatsApp"
        class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-brand-green text-white shadow-lg transition duration-300 hover:scale-110 hover:bg-brand-brown"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-7 w-7"
        >

            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.67.15-.197.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.099-.198.05-.372-.025-.52-.075-.149-.669-.511-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.372.074-.57.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.849 1.213 3.047.149.198 2.095 3.2 5.076 4.487.709-.306 1.262-.489 1.871-.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.987 2.896a9.825 9.825 0 012.893 6.99c-.003 5.45-4.44 9.885-9.888 9.89m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.89c0 2.096.547 4.143 1.588 5.945L.057 24l6.304-1.654a11.89 11.89 0 005.684 1.447h.005c6.554 0 11.89-5.335 11.893-11.89a11.84 11.84 0 00-3.479-8.415"/>
            
        </svg>

    </a>

@endif


</body>

</html>