<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand-green">
                    Admin Panel
                </p>

                <h2 class="mt-1 text-2xl font-semibold tracking-tight text-brand-brown">
                    {{ __('Dashboard') }}
                </h2>
            </div>

        </div>

    </x-slot>


    <div class="py-8 sm:py-10">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- WELCOME CARD --}}
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                <div class="p-6 sm:p-8">

                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <div class="mb-4 h-1 w-10 rounded-full bg-brand-yellow"></div>

                            <h3 class="text-xl font-semibold text-brand-brown">
                                Welcome back, {{ Auth::user()->name }}.
                            </h3>

                            <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                                You are successfully logged in to the administration panel.
                                From here, you can manage your website and content.
                            </p>

                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-brand-yellow/30">

                            <svg
                                class="h-7 w-7 text-brand-green"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- QUICK ACTIONS --}}
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                {{-- CATEGORIES --}}
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-brand-green/20 hover:shadow-md"
                >

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-yellow/30 text-brand-brown">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 text-base font-semibold text-brand-brown">
                        Categories
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-gray-500">
                        Manage your product categories.
                    </p>

                    <span class="mt-4 inline-flex text-sm font-semibold text-brand-green transition group-hover:text-brand-brown">
                        Manage →
                    </span>

                </a>


                {{-- PRODUCTS --}}
                <a
                    href="{{ route('admin.products.index') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-brand-green/20 hover:shadow-md"
                >

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-green/10 text-brand-green">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 text-base font-semibold text-brand-brown">
                        Products
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-gray-500">
                        Add, edit, and manage your products.
                    </p>

                    <span class="mt-4 inline-flex text-sm font-semibold text-brand-green transition group-hover:text-brand-brown">
                        Manage →
                    </span>

                </a>


                {{-- COMPANY PROFILE --}}
                <a
                    href="{{ route('admin.company-profile.edit') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-brand-green/20 hover:shadow-md"
                >

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-brown/10 text-brand-brown">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0h-5m-9 0H3m3 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 text-base font-semibold text-brand-brown">
                        Company Profile
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-gray-500">
                        Update your company information and contact details.
                    </p>

                    <span class="mt-4 inline-flex text-sm font-semibold text-brand-green transition group-hover:text-brand-brown">
                        Manage →
                    </span>

                </a>

            </div>

        </div>

    </div>

</x-app-layout>