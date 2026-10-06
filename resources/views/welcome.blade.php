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
        {{ config('app.name', 'Website') }}
    </title>
</head>

<body class="bg-white text-gray-900">

    <main class="flex min-h-screen items-center justify-center px-6">

        <div class="text-center">

            <div class="mx-auto mb-5 h-1 w-10 rounded-full bg-brand-yellow"></div>

            <h1 class="text-4xl font-bold tracking-tight text-brand-brown sm:text-5xl">
                Welcome
            </h1>

            <p class="mt-3 text-sm text-gray-500">
                Welcome to our website.
            </p>

            <a
                href="{{ route('home') }}"
                class="mt-7 inline-flex items-center rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-brand-brown"
            >
                Visit Website
            </a>

        </div>

    </main>

</body>

</html>