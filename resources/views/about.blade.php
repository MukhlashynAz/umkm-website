<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <title>
        {{ $company?->company_name ?? 'About Us' }}
    </title>

    <x-favicon />

</head>


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
                class="text-sm font-medium text-gray-600 transition hover:text-brand-green"
            >
                Products
            </a>

            <a
                href="{{ route('about') }}"
                class="text-sm font-semibold text-brand-green"
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
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-medium text-gray-700 transition hover:text-brand-green"
                >
                    Products
                </a>

                <a
                    href="{{ route('about') }}"
                    class="mobile-menu-link border-b border-gray-100 py-4 text-sm font-semibold text-brand-green"
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
{{-- HERO --}}
{{-- ========================================================= --}}

<section class="bg-brand-yellow/20">

    <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8 lg:py-16">

        <div class="max-w-3xl">

            @if ($company?->logo)

                <img
                    src="{{ asset('storage/' . $company->logo) }}"
                    alt="{{ $company->company_name ?? 'Company Logo' }}"
                    class="h-14 w-14 rounded-2xl object-contain sm:h-16 sm:w-16"
                >

            @endif


            <p class="mt-6 text-[11px] font-semibold uppercase tracking-[0.3em] text-brand-green">
                About Us
            </p>


            <h1 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-brand-brown sm:text-4xl lg:text-5xl">
                {{ $company?->company_name ?? 'Our Company' }}
            </h1>


            <div class="mt-4 h-1 w-10 rounded-full bg-brand-yellow"></div>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- WHO WE ARE --}}
{{-- ========================================================= --}}

<section class="bg-brand-brown">

    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">

        <div class="max-w-3xl">

            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-yellow">
                Who We Are
            </p>


            <h2 class="mt-3 text-2xl font-bold tracking-tight text-white sm:text-3xl">
                Rooted in Indonesia. Focused on the world.
            </h2>


            <p class="mt-4 text-sm leading-7 text-white/75 sm:text-base">
                {{ $company?->description ?? 'We are committed to providing quality Indonesian crackers and building trusted relationships with buyers around the world.' }}
            </p>

        </div>


        {{-- THREE CORE POINTS --}}
        <div class="mt-10 grid gap-4 lg:grid-cols-3">


            {{-- INDONESIAN ORIGIN --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm">

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-yellow text-xs font-bold text-brand-brown">
                    01
                </div>


                <h3 class="mt-4 text-base font-semibold tracking-tight text-brand-brown">
                    Indonesian Origin
                </h3>


                <p class="mt-3 text-xs leading-6 text-gray-600">
                    Products rooted in the food culture and crackers tradition of Palembang, South Sumatera, Indonesia.
                </p>

            </div>


            {{-- FOCUSED PORTFOLIO --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm">

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-yellow text-xs font-bold text-brand-brown">
                    02
                </div>


                <h3 class="mt-4 text-base font-semibold tracking-tight text-brand-brown">
                    Focused Portfolio
                </h3>


                <p class="mt-3 text-xs leading-6 text-gray-600">
                    A concise range of five signature products that is easy for buyers to review and compare.
                </p>

            </div>


            {{-- GLOBAL ORIENTATION --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm">

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-yellow text-xs font-bold text-brand-brown">
                    03
                </div>


                <h3 class="mt-4 text-base font-semibold tracking-tight text-brand-brown">
                    Global Orientation
                </h3>


                <p class="mt-3 text-xs leading-6 text-gray-600">
                    Clear English-Language presentation and direct channels for international commercial enquiries.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- OUR VISION --}}
{{-- ========================================================= --}}

<section class="bg-brand-yellow/20">

    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">

        <div class="max-w-4xl">

            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-green">
                Our Vision
            </p>


            <blockquote class="mt-5 max-w-4xl text-xl font-medium leading-relaxed text-brand-brown sm:text-2xl lg:text-3xl">
                “To become trusted Indonesian crackers partner for buyers around the world, bringing authentic Indonesian taste to international markets.”
            </blockquote>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- OUR MISSION --}}
{{-- ========================================================= --}}

<section class="bg-brand-brown">

    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">

        <div class="max-w-3xl">

            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-yellow">
                Our Mission
            </p>


            <h2 class="mt-3 text-2xl font-bold tracking-tight text-white sm:text-3xl">
                What we are committed to.
            </h2>

        </div>


        {{-- MISSION CARDS --}}
        <div class="mt-10 grid gap-4 sm:grid-cols-2">


            {{-- 01 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand-green">
                    01
                </p>


                <h3 class="mt-3 text-lg font-semibold tracking-tight text-brand-brown">
                    Bring Authenticity
                </h3>


                <p class="mt-3 text-sm leading-6 text-gray-600">
                    Present Indonesian cracker products with a strong sense of origin and identity.
                </p>

            </div>


            {{-- 02 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand-green">
                    02
                </p>


                <h3 class="mt-3 text-lg font-semibold tracking-tight text-brand-brown">
                    Serve Buyers Clearly
                </h3>


                <p class="mt-3 text-sm leading-6 text-gray-600">
                    Make product information, communication, and commercial enquiries simple and professional.
                </p>

            </div>


            {{-- 03 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand-green">
                    03
                </p>


                <h3 class="mt-3 text-lg font-semibold tracking-tight text-brand-brown">
                    Build Long-Term Trust
                </h3>


                <p class="mt-3 text-sm leading-6 text-gray-600">
                    Develop reliable relationship with importers, distributors, and business partners.
                </p>

            </div>


            {{-- 04 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand-green">
                    04
                </p>


                <h3 class="mt-3 text-lg font-semibold tracking-tight text-brand-brown">
                    Grow Internationally
                </h3>


                <p class="mt-3 text-sm leading-6 text-gray-600">
                    Introduce a distinctive Indonesian product portfolio to more markets around the world.
                </p>

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


</body>

</html>