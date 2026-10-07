@php
    $whatsappNumber = $company?->phone
        ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $company->phone))
        : '';

    $whatsappMessage = 'Halo, saya tertarik untuk memesan produk ' . $product->name . '. Mohon informasi lebih lanjut mengenai ketersediaan dan pemesanannya.';

    $whatsappUrl = $whatsappNumber
        ? 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($whatsappMessage)
        : '#';

    $instagram = $company?->instagram ?? '';

    $instagramUrl = $instagram
        ? (str_starts_with($instagram, 'http')
            ? $instagram
            : 'https://instagram.com/' . ltrim($instagram, '@'))
        : '#';

    $email = $company?->email ?? '';

    $emailSubject = 'Order Produk - ' . $product->name;

    $emailBody = 'Halo, saya tertarik untuk memesan produk ' . $product->name . '. Mohon informasi lebih lanjut mengenai ketersediaan dan pemesanannya.';

    $emailUrl = $email
        ? 'mailto:' . $email
            . '?subject=' . urlencode($emailSubject)
            . '&body=' . urlencode($emailBody)
        : '#';
@endphp


<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
        {{ $product->name }}
        | {{ $company?->company_name ?? 'Product' }}
    </title>

    <x-favicon />

</head>


<body class="bg-white text-gray-900 antialiased">


{{-- ========================================================= --}}
{{-- PRODUCT HERO --}}
{{-- ========================================================= --}}

<section class="bg-brand-yellow/20">

    <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8 lg:py-16">

        <div class="grid items-start gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:gap-14">


            {{-- PRODUCT IMAGE --}}
            <div>

                <div class="relative aspect-square overflow-hidden rounded-[2rem] border border-brand-yellow/50 bg-white shadow-sm">

                    @if ($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-cover transition duration-700 hover:scale-105"
                        >

                    @else

                        <div class="flex h-full w-full items-center justify-center bg-brand-yellow/10">

                            <div class="text-center">

                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-brand-yellow text-brand-brown">
                                    →
                                </div>

                                <p class="mt-3 text-xs font-semibold uppercase tracking-[0.2em] text-brand-brown/50">
                                    Product Image
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- PRODUCT INFORMATION --}}
            <div class="lg:pt-3">


                {{-- CATEGORY --}}
                <div class="flex items-center gap-3">

                    <span class="h-1 w-8 rounded-full bg-brand-green"></span>

                    <p class="text-[11px] font-semibold uppercase tracking-[0.3em] text-brand-green">
                        {{ $product->category->name }}
                    </p>

                </div>


                {{-- PRODUCT NAME --}}
                <h1 class="mt-4 text-3xl font-bold leading-tight tracking-tight text-brand-brown sm:text-4xl lg:text-5xl">
                    {{ $product->name }}
                </h1>


                {{-- PRICE --}}
                <div class="mt-5">

                    @if ($product->price !== null)

                        <p class="text-2xl font-bold text-brand-green sm:text-3xl">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                    @else

                        <p class="text-lg font-medium text-gray-500">
                            Contact for price
                        </p>

                    @endif

                </div>


                {{-- DESCRIPTION --}}
                @if ($product->description)

                    <div class="mt-7 border-t border-brand-brown/10 pt-6">

                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-brand-green">
                            Description
                        </p>

                        <p class="mt-3 text-sm leading-7 text-gray-600 sm:text-base sm:leading-8">
                            {{ $product->description }}
                        </p>

                    </div>

                @endif


                {{-- ORDER OPTIONS --}}
                <div class="mt-8 border-t border-brand-brown/10 pt-6">

                    <p class="text-sm font-bold text-brand-brown">
                        Order this product
                    </p>

                    <p class="mt-1 text-sm leading-6 text-gray-500">
                        Choose your preferred contact method.
                    </p>


                    <div class="mt-5 grid gap-3 sm:grid-cols-3">


                        {{-- WHATSAPP --}}
                        @if ($whatsappNumber)

                            <a
                                href="{{ $whatsappUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center justify-center rounded-xl bg-brand-green px-5 py-4 text-sm font-semibold text-white transition duration-200 hover:-translate-y-0.5 hover:bg-brand-brown"
                            >
                                WhatsApp
                            </a>

                        @else

                            <span
                                class="flex cursor-not-allowed items-center justify-center rounded-xl bg-gray-100 px-5 py-4 text-sm font-semibold text-gray-400"
                            >
                                WhatsApp
                            </span>

                        @endif


                        {{-- INSTAGRAM --}}
                        @if ($instagram)

                            <a
                                href="{{ $instagramUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center justify-center rounded-xl bg-brand-yellow px-5 py-4 text-sm font-semibold text-brand-brown transition duration-200 hover:-translate-y-0.5 hover:bg-brand-yellow/80"
                            >
                                Instagram
                            </a>

                        @else

                            <span
                                class="flex cursor-not-allowed items-center justify-center rounded-xl bg-gray-100 px-5 py-4 text-sm font-semibold text-gray-400"
                            >
                                Instagram
                            </span>

                        @endif


                        {{-- EMAIL --}}
                        @if ($email)

                            <a
                                href="{{ $emailUrl }}"
                                class="flex items-center justify-center rounded-xl bg-brand-brown px-5 py-4 text-sm font-semibold text-white transition duration-200 hover:-translate-y-0.5 hover:bg-brand-green"
                            >
                                Email
                            </a>

                        @else

                            <span
                                class="flex cursor-not-allowed items-center justify-center rounded-xl bg-gray-100 px-5 py-4 text-sm font-semibold text-gray-400"
                            >
                                Email
                            </span>

                        @endif

                    </div>

                </div>


                {{-- AVAILABILITY --}}
                <div class="mt-5 flex items-center gap-3 text-sm font-medium text-gray-500">

                    <span class="h-2 w-2 rounded-full bg-brand-green"></span>

                    Available for order

                </div>

            </div>

        </div>

    </div>

</section>

</body>

</html>