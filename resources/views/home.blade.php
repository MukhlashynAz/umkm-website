<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $company?->company_name ?? 'Company' }}</title>

</head>

@php
    /*
    |--------------------------------------------------------------------------
    | WHATSAPP
    |--------------------------------------------------------------------------
    */

    $whatsappNumber = $company?->phone
        ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $company->phone))
        : '';

    $whatsappMessage = 'Halo, saya tertarik untuk menghubungi ' .
        ($company?->company_name ?? 'perusahaan') .
        '. Mohon informasi lebih lanjut.';

    $whatsappUrl = $whatsappNumber
        ? 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($whatsappMessage)
        : '';


    /*
    |--------------------------------------------------------------------------
    | INSTAGRAM
    |--------------------------------------------------------------------------
    */

    $instagramUrl = '';

    if ($company?->instagram) {
        $instagramUrl = str_starts_with($company->instagram, 'http')
            ? $company->instagram
            : 'https://instagram.com/' . ltrim($company->instagram, '@');
    }
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
                href="#home"
                class="text-sm font-medium text-gray-600 transition hover:text-brand-green"
            >
                Home
            </a>

            <a
                href="{{ route('categories.index') }}"
                class="text-sm font-medium text-gray-600 transition hover:text-brand-green"
            >
                Products
            </a>

            <a
                href="#about"
                class="text-sm font-medium text-gray-600 transition hover:text-brand-green"
            >
                About
            </a>

            <a
                href="#contact"
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
                href="#contact"
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
                    href="#home"
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-medium text-gray-700 transition hover:text-brand-green"
                >
                    Home
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-medium text-gray-700 transition hover:text-brand-green"
                >
                    Products
                </a>

                <a
                    href="#about"
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-medium text-gray-700 transition hover:text-brand-green"
                >
                    About
                </a>

                <a
                    href="#contact"
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
{{-- HERO --}}
{{-- ========================================================= --}}

<section
    id="home"
    class="relative overflow-hidden bg-brand-yellow/20"
>

    <div class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">

        <div class="grid items-center gap-8 lg:grid-cols-2 lg:gap-12">

            {{-- LEFT --}}
            <div>

                <div class="flex items-center gap-3">

                    <span class="h-1 w-8 rounded-full bg-brand-yellow"></span>

                    <p class="text-[11px] font-semibold uppercase tracking-[0.3em] text-brand-green">
                        {{ $company?->company_name ?? 'Professional & Trusted' }}
                    </p>

                </div>


                <h1 class="mt-3 text-3xl font-bold leading-[1.05] tracking-tight text-brand-brown sm:text-4xl lg:text-5xl">

                    Quality Products.

                    <br>

                    <span class="text-brand-green">
                        Reliable Solutions.
                    </span>

                </h1>


                <p class="mt-3 max-w-2xl text-xs leading-6 text-brand-brown/70 sm:text-sm">
                    {{ $company?->description ?? 'Discover quality products and reliable solutions for your business needs.' }}
                </p>

            </div>


            {{-- RIGHT --}}
            @if ($categories->count() > 0)

                <div class="min-w-0">

                    <div class="mb-3 flex items-center justify-between">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-brand-brown">
                            Explore Categories
                        </p>


                        @if ($categories->count() > 1)

                            <div class="flex gap-2">

                                <button
                                    type="button"
                                    id="category-prev"
                                    class="flex h-8 w-8 items-center justify-center rounded-full border border-brand-brown/20 bg-white text-brand-green transition hover:bg-brand-green hover:text-white"
                                    aria-label="Previous category"
                                >
                                    ←
                                </button>


                                <button
                                    type="button"
                                    id="category-next"
                                    class="flex h-8 w-8 items-center justify-center rounded-full border border-brand-brown/20 bg-white text-brand-green transition hover:bg-brand-green hover:text-white"
                                    aria-label="Next category"
                                >
                                    →
                                </button>

                            </div>

                        @endif

                    </div>


                    <div
                        id="category-carousel"
                        class="relative h-[190px] w-full overflow-hidden rounded-2xl bg-brand-brown/10"
                    >

                        <div
                            id="category-track"
                            class="flex h-full transition-transform duration-500 ease-out"
                        >

                            @foreach ($categories as $category)

                                <a
                                    href="{{ route('categories.products', $category->slug) }}"
                                    class="relative h-[190px] w-full shrink-0 overflow-hidden"
                                >

                                    @if ($category->image)

                                        <img
                                            src="{{ asset('storage/' . $category->image) }}"
                                            alt="{{ $category->name }}"
                                            class="absolute inset-0 h-full w-full object-cover"
                                        >

                                    @else

                                        <div class="absolute inset-0 flex items-center justify-center bg-brand-brown/10">

                                            <span class="text-xs font-medium uppercase tracking-wider text-brand-brown/50">
                                                Category Image
                                            </span>

                                        </div>

                                    @endif


                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                    </div>


                                    <div class="absolute bottom-0 left-0 right-0 p-5">

                                        <p class="text-base font-semibold text-white">
                                            {{ $category->name }}
                                        </p>


                                        <p class="mt-1 text-xs text-white/70">

                                            {{ $category->products->count() }}

                                            {{ $category->products->count() === 1 ? 'Product' : 'Products' }}

                                        </p>

                                    </div>

                                </a>

                            @endforeach

                        </div>

                    </div>


                    @if ($categories->count() > 1)

                        <div class="mt-3 flex justify-center gap-1.5">

                            @foreach ($categories as $index => $category)

                                <button
                                    type="button"
                                    data-category-index="{{ $index }}"
                                    class="category-dot h-1.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'w-6 bg-brand-green' : 'w-1.5 bg-brand-brown/20' }}"
                                    aria-label="Go to category {{ $index + 1 }}"
                                ></button>

                            @endforeach

                        </div>

                    @endif

                </div>

            @endif

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- HERO CAROUSEL SCRIPT --}}
{{-- ========================================================= --}}

@if ($categories->count() > 1)

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const track = document.getElementById('category-track');

            const carousel = document.getElementById('category-carousel');

            const nextButton = document.getElementById('category-next');

            const prevButton = document.getElementById('category-prev');

            const dots = document.querySelectorAll('.category-dot');

            if (!track || !carousel) {
                return;
            }

            const totalSlides = {{ $categories->count() }};

            let currentIndex = 0;

            let startX = 0;


            function updateCarousel(index) {

                if (index >= totalSlides) {
                    index = 0;
                }

                if (index < 0) {
                    index = totalSlides - 1;
                }

                currentIndex = index;

                track.style.transform =
                    'translateX(-' + (currentIndex * 100) + '%)';


                dots.forEach(function (dot, dotIndex) {

                    if (dotIndex === currentIndex) {

                        dot.classList.remove(
                            'w-1.5',
                            'bg-brand-brown/20'
                        );

                        dot.classList.add(
                            'w-6',
                            'bg-brand-green'
                        );

                    } else {

                        dot.classList.remove(
                            'w-6',
                            'bg-brand-green'
                        );

                        dot.classList.add(
                            'w-1.5',
                            'bg-brand-brown/20'
                        );

                    }

                });

            }


            function nextSlide() {
                updateCarousel(currentIndex + 1);
            }


            function previousSlide() {
                updateCarousel(currentIndex - 1);
            }


            if (nextButton) {

                nextButton.addEventListener('click', function () {
                    nextSlide();
                });

            }


            if (prevButton) {

                prevButton.addEventListener('click', function () {
                    previousSlide();
                });

            }


            dots.forEach(function (dot) {

                dot.addEventListener('click', function () {

                    const index = Number(
                        dot.dataset.categoryIndex
                    );

                    updateCarousel(index);

                });

            });


            carousel.addEventListener(
                'touchstart',
                function (event) {

                    startX = event.touches[0].clientX;

                },
                {
                    passive: true
                }
            );


            carousel.addEventListener(
                'touchend',
                function (event) {

                    const endX = event.changedTouches[0].clientX;

                    const distance = startX - endX;


                    if (Math.abs(distance) < 40) {
                        return;
                    }


                    if (distance > 0) {
                        nextSlide();
                    } else {
                        previousSlide();
                    }

                },
                {
                    passive: true
                }
            );


            setInterval(function () {

                nextSlide();

            }, 5000);

        });

    </script>

@endif


{{-- ========================================================= --}}
{{-- FEATURED PRODUCTS --}}
{{-- ========================================================= --}}

@if ($featuredProducts->isNotEmpty())

    <section
        id="featured-products"
        class="overflow-hidden bg-brand-brown"
    >

        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8 lg:py-16">

            <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">

                <div class="text-white">

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-yellow">
                        Featured Products
                    </p>

                    <h2 class="mt-4 text-4xl font-bold tracking-tight sm:text-5xl">
                        Selected for you.
                    </h2>

                    <p class="mt-5 max-w-xl text-base leading-7 text-white/70">
                        Take a closer look at some of our selected products.
                    </p>

                </div>


                <a
                    href="{{ route('categories.index') }}"
                    class="text-sm font-medium text-white/70 transition hover:text-brand-yellow"
                >
                    View all products →
                </a>

            </div>


            <div
                id="featured-carousel"
                class="relative mt-12 overflow-hidden rounded-[2rem] bg-white"
            >

                @foreach ($featuredProducts as $index => $product)

                    <div
                        class="featured-slide {{ $index === 0 ? '' : 'hidden' }}"
                    >

                        <div class="grid min-h-[400px] lg:grid-cols-2">

                            <div class="relative h-[300px] overflow-hidden bg-gray-100 lg:h-auto">

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


                            <div class="flex flex-col justify-center px-8 py-12 sm:px-12 lg:px-16">

                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand-green">
                                    {{ $product->category->name }}
                                </p>


                                <h3 class="mt-5 text-4xl font-bold leading-tight tracking-tight text-brand-brown sm:text-5xl">
                                    {{ $product->name }}
                                </h3>


                                @if ($product->description)

                                    <p class="mt-6 max-w-xl text-base leading-8 text-gray-600">
                                        {{ $product->description }}
                                    </p>

                                @endif


                                @if ($product->price !== null)

                                    <p class="mt-6 text-2xl font-bold text-brand-brown">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                @endif


                                <div class="mt-8">

                                    <a
                                        href="{{ route('products.show', $product->slug) }}"
                                        class="inline-flex items-center rounded-full bg-brand-green px-7 py-3.5 text-sm font-semibold text-white transition hover:bg-brand-brown"
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


    @if ($featuredProducts->count() > 1)

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

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


                    setInterval(
                        changeSlide,
                        5000
                    );

                }
            );

        </script>

    @endif

@endif


{{-- ========================================================= --}}
{{-- EXPLORE OUR PRODUCTS / CATEGORIES --}}
{{-- ========================================================= --}}

<section
    id="products"
    class="bg-brand-yellow/20"
>

    <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32">

        <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">

            <div class="max-w-2xl">

                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-green">
                    Our Products
                </p>

                <h2 class="mt-4 text-4xl font-bold tracking-tight text-brand-brown sm:text-5xl">
                    Explore Our Products
                </h2>

                <p class="mt-5 text-base leading-7 text-gray-600">
                    Explore our product collection by category.
                </p>

            </div>


            <a
                href="{{ route('categories.index') }}"
                class="text-sm font-semibold text-brand-brown transition hover:text-brand-green"
            >
                View all categories →
            </a>

        </div>


        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($categories as $category)

                <a
                    href="{{ route('categories.products', $category->slug) }}"
                    class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-brand-green/30 hover:shadow-xl"
                >

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


                    <div class="p-6">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h3 class="text-xl font-semibold tracking-tight text-brand-brown">
                                    {{ $category->name }}
                                </h3>

                                <p class="mt-2 text-sm text-gray-500">

                                    {{ $category->products->count() }}

                                    {{ $category->products->count() === 1 ? 'Product' : 'Products' }}

                                </p>

                            </div>


                            <span class="text-brand-green transition duration-300 group-hover:translate-x-1">
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
    class="bg-brand-brown"
>

    <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32">

        <div class="grid gap-12 lg:grid-cols-2 lg:gap-20">

            <div>

                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-yellow">
                    About Us
                </p>

                <h2 class="mt-4 text-4xl font-bold leading-tight tracking-tight text-white sm:text-5xl">

                    Built around

                    <span class="text-brand-yellow">
                        quality & trust.
                    </span>

                </h2>

            </div>


            <div>

                <p class="text-base leading-8 text-white/80 sm:text-lg">

                    {{ $company?->description ?? 'We are committed to providing quality products and reliable solutions for our customers.' }}

                </p>


                @if ($company?->address)

                    <div class="mt-10 border-t border-white/20 pt-7">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-brand-yellow">
                            Our Location
                        </p>

                        <p class="mt-3 text-white/80">
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
    class="bg-brand-yellow/20"
>

    <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8 lg:py-32">

        <div class="overflow-hidden rounded-[2rem] bg-brand-green">

            <div class="grid lg:grid-cols-2">

                {{-- LEFT --}}
                <div class="px-8 py-16 sm:px-12 lg:px-16 lg:py-20">

                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-yellow">
                        Get In Touch
                    </p>

                    <h2 class="mt-5 text-4xl font-bold leading-tight tracking-tight text-white sm:text-5xl">
                        Let's work together.
                    </h2>

                    <p class="mt-6 max-w-lg text-base leading-7 text-white/80">
                        Have questions about our products? Reach out to us and our team will be happy to assist you.
                    </p>


                    {{-- WHATSAPP BUTTON --}}
                    @if ($whatsappNumber)

                        <a
                            href="{{ $whatsappUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-9 inline-flex rounded-full bg-brand-yellow px-7 py-3.5 text-sm font-semibold text-brand-brown transition hover:bg-white"
                        >
                            Chat via WhatsApp
                        </a>

                    @endif

                </div>


                {{-- RIGHT --}}
                <div class="border-t border-white/20 px-8 py-12 sm:px-12 lg:border-l lg:border-t-0 lg:px-16 lg:py-20">

                    <div class="space-y-8">


                        {{-- PHONE --}}
                        @if ($company?->phone)

                            <div>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-white/60">
                                    Phone / WhatsApp
                                </p>

                                <a
                                    href="{{ $whatsappUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-2 block text-lg font-medium text-white transition hover:text-brand-yellow"
                                >
                                    {{ $company->phone }}
                                </a>

                            </div>

                        @endif


                        {{-- EMAIL --}}
                        @if ($company?->email)

                            <div>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-white/60">
                                    Email
                                </p>

                                <a
                                    href="mailto:{{ $company->email }}"
                                    class="mt-2 block break-all text-lg font-medium text-white transition hover:text-brand-yellow"
                                >
                                    {{ $company->email }}
                                </a>

                            </div>

                        @endif


                        {{-- INSTAGRAM --}}
                        @if ($company?->instagram)

                            <div>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-white/60">
                                    Instagram
                                </p>

                                <a
                                    href="{{ $instagramUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-2 block text-lg font-medium text-white transition hover:text-brand-yellow"
                                >
                                    {{ $company->instagram }}
                                </a>

                            </div>

                        @endif


                        {{-- ADDRESS --}}
                        @if ($company?->address)

                            <div>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-white/60">
                                    Address
                                </p>

                                <p class="mt-2 text-base leading-7 text-white/75">
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

            <p class="text-xs text-brand-brown/70">
                &copy; {{ date('Y') }}
                {{ $company?->company_name ?? 'Company' }}.
                All rights reserved.
            </p>

        </div>


        <a
            href="{{ route('login') }}"
            class="text-xs font-medium text-brand-brown transition hover:text-brand-green"
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
        href="{{ $whatsappUrl }}"
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

            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.67.15-.197.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.099-.198.05-.372-.025-.52-.075-.149-.669-.511-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.372.074-.57.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.849 1.213 3.047.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.987 2.896a9.825 9.825 0 012.893 6.99c-.003 5.45-4.44 9.885-9.888 9.89m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.89c0 2.096.547 4.143 1.588 5.945L.057 24l6.304-1.654a11.89 11.89 0 005.684 1.447h.005c6.554 0 11.89-5.335 11.893-11.89a11.84 11.84 0 00-3.479-8.415"/>
            
        </svg>

    </a>

@endif


</body>

</html>