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
</head>

<body class="bg-white text-gray-900">

    <main class="min-h-screen">

        {{-- NAVIGATION --}}
        <nav class="border-b border-gray-100 bg-white">

            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-8">

                <a
                    href="{{ route('categories.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-brand-green"
                >
                    <span class="text-lg">←</span>
                    Back to Products
                </a>

                @if ($company?->company_name)
                    <span class="hidden text-sm font-semibold text-brand-brown sm:block">
                        {{ $company->company_name }}
                    </span>
                @endif

            </div>

        </nav>


        {{-- PRODUCT CONTENT --}}
        <div class="mx-auto max-w-6xl px-6 py-10 sm:py-16 lg:px-8">

            <div class="grid items-start gap-10 lg:grid-cols-2 lg:gap-16">

                {{-- PRODUCT IMAGE --}}
                <div class="overflow-hidden rounded-3xl border border-gray-100 bg-gray-50">

                    @if ($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="aspect-square w-full object-cover"
                        >

                    @else

                        <div class="flex aspect-square items-center justify-center">

                            <span class="text-sm font-medium uppercase tracking-[0.2em] text-gray-400">
                                Product Image
                            </span>

                        </div>

                    @endif

                </div>


                {{-- PRODUCT INFORMATION --}}
                <div class="lg:pt-4">

                    {{-- CATEGORY --}}
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-brand-green">
                        {{ $product->category->name }}
                    </p>


                    {{-- PRODUCT NAME --}}
                    <h1 class="mt-4 text-4xl font-bold tracking-tight text-brand-brown sm:text-5xl">
                        {{ $product->name }}
                    </h1>


                    {{-- PRICE --}}
                    <div class="mt-6">

                        @if ($product->price)

                            <p class="text-2xl font-bold text-brand-green">
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

                        <div class="mt-7 border-t border-gray-100 pt-7">

                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-500">
                                Description
                            </p>

                            <p class="mt-3 text-base leading-8 text-gray-600">
                                {{ $product->description }}
                            </p>

                        </div>

                    @endif


                    {{-- ORDER OPTIONS --}}
                    <div class="mt-9 border-t border-gray-100 pt-7">

                        <p class="text-sm font-bold text-brand-brown">
                            Order this product
                        </p>

                        <p class="mt-1 text-sm text-gray-500">
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
                    <div class="mt-6 flex items-center gap-3 text-sm font-medium text-gray-500">

                        <span class="h-2 w-2 rounded-full bg-brand-green"></span>

                        Available for order

                    </div>

                </div>

            </div>

        </div>

    </main>

</body>

</html>
