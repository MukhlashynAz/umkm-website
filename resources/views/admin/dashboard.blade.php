<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Admin Dashboard</title>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900">

    <div class="mx-auto max-w-7xl px-6 py-10 lg:px-8">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-3xl font-bold tracking-tight">
                    Admin Dashboard
                </h1>

                <p class="mt-2 text-gray-500">
                    Manage your website content.
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:border-gray-900 hover:text-gray-900"
                >
                    Logout
                </button>
            </form>

        </div>


        {{-- STATISTICS --}}
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- CATEGORIES --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-gray-500">
                    Categories
                </p>

                <p class="mt-2 text-3xl font-bold">
                    {{ $categoryCount }}
                </p>

            </div>


            {{-- PRODUCTS --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-gray-500">
                    Products
                </p>

                <p class="mt-2 text-3xl font-bold">
                    {{ $productCount }}
                </p>

            </div>


            {{-- ACTIVE PRODUCTS --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-gray-500">
                    Active Products
                </p>

                <p class="mt-2 text-3xl font-bold">
                    {{ $activeProductCount }}
                </p>

            </div>


            {{-- COMPANY PROFILE --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-gray-500">
                    Company Profile
                </p>

                @if ($companyProfile)
                    <p class="mt-2 text-lg font-bold text-green-600">
                        Configured
                    </p>
                @else
                    <p class="mt-2 text-lg font-bold text-red-500">
                        Not Configured
                    </p>
                @endif

            </div>

        </div>


        {{-- MENU --}}
        <div class="mt-10">

            <h2 class="text-xl font-bold">
                Manage Website
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Manage the content displayed on your website.
            </p>

        </div>


        <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            {{-- CATEGORIES --}}
            <a
                href="{{ route('admin.categories.index') }}"
                class="group rounded-2xl border border-gray-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-gray-300 hover:shadow-lg"
            >

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-900 text-white">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                        />
                    </svg>

                </div>

                <h3 class="mt-6 text-xl font-bold">
                    Categories
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Manage product categories, descriptions, and category images.
                </p>

                <div class="mt-6 text-sm font-semibold text-gray-900">
                    Manage Categories

                    <span class="ml-1 transition-transform group-hover:translate-x-1">
                        →
                    </span>
                </div>

            </a>


            {{-- PRODUCTS --}}
            <a
                href="{{ route('admin.products.index') }}"
                class="group rounded-2xl border border-gray-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-gray-300 hover:shadow-lg"
            >

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-900 text-white">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9l-8.25 4.5-8.25-4.5v-9m16.5 0L12 12m0 0L3.75 7.5M12 12v9"
                        />
                    </svg>

                </div>

                <h3 class="mt-6 text-xl font-bold">
                    Products
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Add, edit, delete, and manage products displayed on the website.
                </p>

                <div class="mt-6 text-sm font-semibold text-gray-900">
                    Manage Products

                    <span class="ml-1 transition-transform group-hover:translate-x-1">
                        →
                    </span>
                </div>

            </a>


            {{-- COMPANY PROFILE --}}
            <a
                href="{{ route('admin.company-profile.edit') }}"
                class="group rounded-2xl border border-gray-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-gray-300 hover:shadow-lg"
            >

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-900 text-white">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 21h16.5M4.5 3h15A1.5 1.5 0 0 1 21 4.5v15A1.5 1.5 0 0 1 19.5 21h-15A1.5 1.5 0 0 1 3 19.5v-15A1.5 1.5 0 0 1 4.5 3zM8 7h8M8 11h8M8 15h5"
                        />
                    </svg>

                </div>

                <h3 class="mt-6 text-xl font-bold">
                    Company Profile
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Manage company information, contact details, social media, and logo.
                </p>

                <div class="mt-6 text-sm font-semibold text-gray-900">
                    Manage Company Profile

                    <span class="ml-1 transition-transform group-hover:translate-x-1">
                        →
                    </span>
                </div>

            </a>

        </div>

    </div>

</body>
</html>