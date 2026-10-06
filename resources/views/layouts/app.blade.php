<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- FAVICON --}}
    @if ($companyProfile && $companyProfile->logo)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $companyProfile->logo) }}">
    @endif

    {{-- FONTS --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />

    {{-- SCRIPTS --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="font-sans antialiased text-gray-900">

    <div class="min-h-screen bg-gray-50">

        {{-- NAVIGATION --}}
        @include('layouts.navigation')

        {{-- PAGE HEADING --}}
        @isset($header)

            <header class="border-b border-gray-100 bg-white">

                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

                    {{ $header }}

                </div>

            </header>

        @endisset

        {{-- PAGE CONTENT --}}
        <main>

            {{ $slot }}

        </main>

    </div>

</body>

</html>