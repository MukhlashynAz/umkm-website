@php
    $whatsappNumber = $company?->phone
        ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $company->phone))
        : '6285381780108';

    $whatsappMessage = 'Halo, saya tertarik untuk memesan produk ' . $product->name . '.';
    $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($whatsappMessage);

    $instagram = $company?->instagram ?? '';

    $instagramUrl = $instagram
        ? (str_starts_with($instagram, 'http')
            ? $instagram
            : 'https://instagram.com/' . ltrim($instagram, '@'))
        : '#';

    $email = $company?->email ?? '';

    $emailSubject = 'Order Produk - ' . $product->name;
    $emailBody = 'Halo, saya tertarik untuk memesan produk ' . $product->name . '.';

    $emailUrl = $email
        ? 'mailto:' . $email
            . '?subject=' . urlencode($emailSubject)
            . '&body=' . urlencode($emailBody)
        : '#';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>
        {{ $product->name }}
        | {{ $company?->company_name ?? 'Product' }}
    </title>
</head>

<body class="bg-white text-gray-900">

    <main class="min-h-screen">

        <div class="mx-auto max-w-6xl px-6 py-10 sm:py-16 lg:px-8">

            <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">

                {{-- PRODUCT IMAGE --}}
                <div class="overflow-hidden rounded-3xl bg-gray-100">

                    @if ($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="aspect-square w-full object-cover"
                        >

                    @else

                        <div class="flex aspect-square items-center justify-center">

                            <span class="text-sm uppercase tracking-[0.2em] text-gray-400">
                                Product Image
                            </span>

                        </div>

                    @endif

                </div>


                {{-- PRODUCT INFORMATION --}}
                <div>

                    {{-- CATEGORY --}}
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-600">
                        {{ $product->category->name }}
                    </p>


                    {{-- PRODUCT NAME --}}
                    <h1 class="mt-4 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                        {{ $product->name }}
                    </h1>


                    {{-- PRICE --}}
                    <div class="mt-6">

                        @if ($product->price)

                            <p class="text-2xl font-semibold text-gray-900">
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

                            <p class="text-sm font-semibold uppercase tracking-wider text-gray-500">
                                Description
                            </p>

                            <p class="mt-3 text-base leading-8 text-gray-600">
                                {{ $product->description }}
                            </p>

                        </div>

                    @endif


                    {{-- ORDER OPTIONS --}}
                    <div class="mt-9 border-t border-gray-100 pt-7">

                        <p class="text-sm font-semibold text-gray-900">
                            Order this product
                        </p>

                        <p class="mt-1 text-sm text-gray-500">
                            Choose your preferred contact method.
                        </p>


                        <div class="mt-5 grid gap-3 sm:grid-cols-3">

                            {{-- WHATSAPP --}}
                            <a
                                href="{{ $whatsappUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center justify-center rounded-2xl bg-[#25D366] px-5 py-4 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#20bd5a]"
                            >
                                WhatsApp
                            </a>


                            {{-- INSTAGRAM --}}
                            @if ($instagram)

                                <a
                                    href="{{ $instagramUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#833AB4] via-[#E1306C] to-[#FCAF45] px-5 py-4 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:opacity-90"
                                >
                                    Instagram
                                </a>

                            @else

                                <span
                                    class="flex cursor-not-allowed items-center justify-center rounded-2xl bg-gray-100 px-5 py-4 text-sm font-semibold text-gray-400"
                                >
                                    Instagram
                                </span>

                            @endif


                            {{-- EMAIL --}}
                            @if ($email)

                                <a
                                    href="{{ $emailUrl }}"
                                    class="flex items-center justify-center rounded-2xl bg-[#EA4335] px-5 py-4 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#d93025]"
                                >
                                    Email
                                </a>

                            @else

                                <span
                                    class="flex cursor-not-allowed items-center justify-center rounded-2xl bg-gray-100 px-5 py-4 text-sm font-semibold text-gray-400"
                                >
                                    Email
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- AVAILABILITY --}}
                    <div class="mt-6 flex items-center gap-3 text-sm text-gray-500">

                        <span class="h-2 w-2 rounded-full bg-green-500"></span>

                        Available for order

                    </div>

                </div>

            </div>

        </div>

    </main>

</body>
</html>