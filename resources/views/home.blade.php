<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $company?->company_name ?? 'Company' }}</title>
</head>

@php
    $whatsappNumber = $company?->phone
        ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $company->phone))
        : '6285381780108';

    $featuredProducts = $products
        ->shuffle()
        ->take(4);
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
                    href="#home"
                    class="text-sm font-medium text-gray-600 transition hover:text-gray-900"
                >
                    Home
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="text-sm font-medium text-gray-600 transition hover:text-gray-900"
                >
                    Products
                </a>

                <a
                    href="#about"
                    class="text-sm font-medium text-gray-600 transition hover:text-gray-900"
                >
                    About
                </a>

                <a
                    href="#contact"
                    class="text-sm font-medium text-gray-600 transition hover:text-gray-900"
                >
                    Contact
                </a>

            </div>


            {{-- ACTION --}}
            <div class="flex items-center gap-3">

                {{-- ADMIN --}}
                <a
                    href="{{ route('login') }}"
                    class="text-sm font-medium text-gray-500 transition hover:text-gray-900"
                >
                    Admin
                </a>

                {{-- CONTACT --}}
                <a
                    href="#contact"
                    class="rounded-full bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700"
                >
                    Contact
                </a>

            </div>

        </div>

    </nav>


    {{-- ========================================================= --}}
    {{-- HERO --}}
    {{-- ========================================================= --}}

    <section
        id="home"
        class="relative overflow-hidden bg-gray-50"
    >

        <div class="mx-auto flex min-h-[560px] max-w-7xl items-center px-6 py-20 lg:px-8 lg:py-24">

            <div class="max-w-3xl">

                <div class="flex items-center gap-3">

                    <span class="h-px w-10 bg-amber-500"></span>

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-600">
                        {{ $company?->company_name ?? 'Professional & Trusted' }}
                    </p>

                </div>


                <h1 class="mt-6 text-5xl font-bold leading-[1.05] tracking-tight text-gray-900 sm:text-6xl lg:text-7xl">

                    Quality Products.
                    <br>

                    <span class="text-gray-400">
                        Reliable Solutions.
                    </span>

                </h1>


                <p class="mt-7 max-w-2xl text-base leading-8 text-gray-600 sm:text-lg">

                    {{ $company?->description ?? 'Discover quality products and reliable solutions for your business needs.' }}

                </p>


                <div class="mt-9 flex flex-wrap gap-3">

                    <a
                        href="{{ route('categories.index') }}"
                        class="rounded-full bg-gray-900 px-7 py-3.5 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-gray-700"
                    >
                        Explore Products
                    </a>

                    <a
                        href="#contact"
                        class="rounded-full border border-gray-300 bg-white px-7 py-3.5 text-sm font-semibold text-gray-900 transition hover:border-gray-900"
                    >
                        Contact Us
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- INTRO --}}
    {{-- ========================================================= --}}

    <section class="bg-white">

        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32">

            <div class="grid gap-12 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-600">
                        Welcome
                    </p>

                    <h2 class="mt-4 text-4xl font-bold leading-tight tracking-tight sm:text-5xl">
                        Everything you need,
                        <span class="text-gray-400">
                            in one place.
                        </span>
                    </h2>

                </div>


                <div>

                    <p class="text-base leading-8 text-gray-600 sm:text-lg">
                        {{ $company?->description ?? 'Welcome to our company. We provide quality products and reliable solutions for our customers.' }}
                    </p>

                    <a
                        href="{{ route('categories.index') }}"
                        class="mt-7 inline-flex items-center text-sm font-semibold text-gray-900 transition hover:text-amber-600"
                    >
                        Explore our collection

                        <span class="ml-2">
                            →
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- FEATURED PRODUCTS --}}
    {{-- ========================================================= --}}

    @if ($featuredProducts->isNotEmpty())

        <section
            id="featured-products"
            class="overflow-hidden bg-gray-900"
        >

            <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-28">

                {{-- HEADER --}}
                <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">

                    <div class="text-white">

                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-400">
                            Featured Products
                        </p>

                        <h2 class="mt-4 text-4xl font-bold tracking-tight sm:text-5xl">
                            Selected for you.
                        </h2>

                        <p class="mt-5 max-w-xl text-base leading-7 text-gray-400">
                            Take a closer look at some of our selected products.
                        </p>

                    </div>


                    <a
                        href="{{ route('categories.index') }}"
                        class="text-sm font-medium text-gray-400 transition hover:text-white"
                    >
                        View all products →
                    </a>

                </div>


                {{-- CAROUSEL --}}
                <div
                    id="featured-carousel"
                    class="relative mt-12 overflow-hidden rounded-[2rem] bg-white"
                >

                    @foreach ($featuredProducts as $index => $product)

                        <div
                            class="featured-slide {{ $index === 0 ? '' : 'hidden' }}"
                        >

                            <div class="grid min-h-[500px] lg:grid-cols-2">

                                {{-- IMAGE --}}
                                <div class="relative h-[360px] overflow-hidden bg-gray-100 lg:h-auto">

                                    @if ($product->image)

                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="absolute inset-0 h-full w-full object-cover"
                                        >

                                    @else

                                        <div class="flex h-full min-h-[360px] items-center justify-center">

                                            <span class="text-xs font-medium uppercase tracking-wider text-gray-400">
                                                Product Image
                                            </span>

                                        </div>

                                    @endif

                                </div>


                                {{-- INFORMATION --}}
                                <div class="flex flex-col justify-center px-8 py-12 sm:px-12 lg:px-16">

                                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-600">
                                        {{ $product->category->name }}
                                    </p>

                                    <h3 class="mt-5 text-4xl font-bold leading-tight tracking-tight text-gray-900 sm:text-5xl">
                                        {{ $product->name }}
                                    </h3>


                                    @if ($product->description)

                                        <p class="mt-6 max-w-xl text-base leading-8 text-gray-600">
                                            {{ $product->description }}
                                        </p>

                                    @endif


                                    @if ($product->price !== null)

                                        <p class="mt-6 text-2xl font-bold text-gray-900">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>

                                    @endif


                                    <div class="mt-8">

                                        <a
                                            href="{{ route('products.show', $product->slug) }}"
                                            class="inline-flex items-center rounded-full bg-gray-900 px-7 py-3.5 text-sm font-semibold text-white transition hover:bg-gray-700"
                                        >
                                            View Product

                                            <span class="ml-2">
                                                →
                                            </span>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- AUTOMATIC CAROUSEL --}}
        @if ($featuredProducts->count() > 1)

            <script>
                document.addEventListener('DOMContentLoaded', function () {

                    const slides = document.querySelectorAll(
                        '#featured-carousel .featured-slide'
                    );

                    if (slides.length <= 1) {
                        return;
                    }

                    let currentSlide = 0;

                    function changeSlide() {

                        slides[currentSlide].classList.add('hidden');

                        currentSlide++;

                        if (currentSlide >= slides.length) {
                            currentSlide = 0;
                        }

                        slides[currentSlide].classList.remove('hidden');
                    }

                    setInterval(changeSlide, 5000);

                });
            </script>

        @endif

    @endif


    {{-- ========================================================= --}}
    {{-- EXPLORE OUR PRODUCTS / CATEGORIES --}}
    {{-- ========================================================= --}}

    <section
        id="products"
        class="bg-white"
    >

        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32">

            {{-- HEADER --}}
            <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">

                <div class="max-w-2xl">

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-600">
                        Our Products
                    </p>

                    <h2 class="mt-4 text-4xl font-bold tracking-tight sm:text-5xl">
                        Explore Our Products
                    </h2>

                    <p class="mt-5 text-base leading-7 text-gray-600">
                        Explore our product collection by category.
                    </p>

                </div>


                <a
                    href="{{ route('categories.index') }}"
                    class="text-sm font-semibold text-gray-900 transition hover:text-amber-600"
                >
                    View all categories →
                </a>

            </div>


            {{-- CATEGORY GRID --}}
            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                @forelse ($categories as $category)

                    <a
                        href="{{ route('categories.products', $category->slug) }}"
                        class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-gray-300 hover:shadow-xl"
                    >

                        {{-- CATEGORY IMAGE --}}
                        <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">

                            @if ($category->image)

                                <img
                                    src="{{ asset('storage/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                >

                            @else

                                <div class="flex h-full w-full items-center justify-center">

                                    <span class="text-xs font-medium uppercase tracking-wider text-gray-400">
                                        Category Image
                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- CATEGORY INFORMATION --}}
                        <div class="p-6">

                            <div class="flex items-start justify-between gap-4">

                                <div>

                                    <h3 class="text-xl font-semibold tracking-tight text-gray-900">
                                        {{ $category->name }}
                                    </h3>

                                    <p class="mt-2 text-sm text-gray-500">
                                        {{ $category->products->count() }}
                                        {{ $category->products->count() === 1 ? 'Product' : 'Products' }}
                                    </p>

                                </div>


                                <span class="text-gray-400 transition duration-300 group-hover:translate-x-1 group-hover:text-gray-900">
                                    →
                                </span>

                            </div>


                            @if ($category->description)

                                <p class="mt-4 line-clamp-2 text-sm leading-6 text-gray-500">
                                    {{ $category->description }}
                                </p>

                            @endif

                        </div>

                    </a>

                @empty

                    <div class="col-span-full rounded-2xl border border-dashed border-gray-300 p-12 text-center">

                        <p class="text-sm text-gray-500">
                            Belum ada kategori produk.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- ABOUT --}}
    {{-- ========================================================= --}}

    <section
        id="about"
        class="bg-gray-50"
    >

        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32">

            <div class="grid gap-12 lg:grid-cols-2 lg:gap-20">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-600">
                        About Us
                    </p>

                    <h2 class="mt-4 text-4xl font-bold leading-tight tracking-tight sm:text-5xl">
                        Built around
                        <span class="text-gray-400">
                            quality & trust.
                        </span>
                    </h2>

                </div>


                <div>

                    <p class="text-base leading-8 text-gray-600 sm:text-lg">
                        {{ $company?->description ?? 'We are committed to providing quality products and reliable solutions for our customers.' }}
                    </p>


                    @if ($company?->address)

                        <div class="mt-10 border-t border-gray-200 pt-7">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-400">
                                Our Location
                            </p>

                            <p class="mt-3 text-gray-600">
                                {{ $company->address }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- CONTACT --}}
    {{-- ========================================================= --}}

    <section
        id="contact"
        class="bg-white"
    >

        <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32">

            <div class="overflow-hidden rounded-[2rem] bg-gray-900">

                <div class="grid lg:grid-cols-2">

                    {{-- LEFT --}}
                    <div class="px-8 py-16 sm:px-12 lg:px-16 lg:py-20">

                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-400">
                            Get In Touch
                        </p>

                        <h2 class="mt-5 text-4xl font-bold leading-tight tracking-tight text-white sm:text-5xl">
                            Let's work together.
                        </h2>

                        <p class="mt-6 max-w-lg text-base leading-7 text-gray-400">
                            Have questions about our products? Reach out to us and our team will be happy to assist you.
                        </p>


                        <a
                            href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo, saya ingin mendapatkan informasi mengenai produk ' . ($company?->company_name ?? 'perusahaan') . '.') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-9 inline-flex rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-gray-900 transition hover:bg-gray-100"
                        >
                            Chat via WhatsApp
                        </a>

                    </div>


                    {{-- RIGHT --}}
                    <div class="border-t border-gray-800 px-8 py-12 sm:px-12 lg:border-l lg:border-t-0 lg:px-16 lg:py-20">

                        <div class="space-y-8">

                            @if ($company?->phone)

                                <div>

                                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-500">
                                        Phone / WhatsApp
                                    </p>

                                    <a
                                        href="https://wa.me/{{ $whatsappNumber }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="mt-2 block text-lg font-medium text-white transition hover:text-amber-300"
                                    >
                                        {{ $company->phone }}
                                    </a>

                                </div>

                            @endif


                            @if ($company?->email)

                                <div>

                                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-500">
                                        Email
                                    </p>

                                    <a
                                        href="mailto:{{ $company->email }}"
                                        class="mt-2 block break-all text-lg font-medium text-white transition hover:text-amber-300"
                                    >
                                        {{ $company->email }}
                                    </a>

                                </div>

                            @endif


                            @if ($company?->instagram)

                                <div>

                                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-500">
                                        Instagram
                                    </p>

                                    <p class="mt-2 text-lg font-medium text-white">
                                        {{ $company->instagram }}
                                    </p>

                                </div>

                            @endif


                            @if ($company?->address)

                                <div>

                                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-gray-500">
                                        Address
                                    </p>

                                    <p class="mt-2 text-base leading-7 text-gray-400">
                                        {{ $company->address }}
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

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


            {{-- ADMIN LOGIN --}}
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
        rel="noopener noreferrer"
        aria-label="Chat via WhatsApp"
        class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white shadow-lg transition duration-300 hover:scale-110 hover:bg-green-600"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-7 w-7"
        >
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.67.15-.197.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.099-.198.05-.372-.025-.52-.075-.149-.669-1.611-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.372.074-.57.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.849 1.213 3.047.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.987 2.896a9.825 9.825 0 012.893 6.99c-.003 5.45-4.44 9.885-9.888 9.89m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.89c0 2.096.547 4.143 1.588 5.945L.057 24l6.304-1.654a11.89 11.89 0 005.684 1.447h.005c6.554 0 11.89-5.335 11.893-11.89a11.84 11.84 0 00-3.479-8.415"/>
        </svg>

    </a>

</body>

</html>