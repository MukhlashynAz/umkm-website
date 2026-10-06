<nav
    x-data="{ open: false }"
    class="sticky top-0 z-40 border-b border-gray-100 bg-white"
>
    {{-- PRIMARY NAVIGATION --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center">

                {{-- LOGO --}}
                <div class="flex shrink-0 items-center">

                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3"
                    >
                        <x-application-logo
                            class="block h-9 w-auto text-brand-green"
                        />

                        <span class="hidden text-sm font-semibold tracking-tight text-brand-brown sm:block">
                            Admin Panel
                        </span>
                    </a>

                </div>

                {{-- DESKTOP NAVIGATION --}}
                <div class="hidden sm:ms-10 sm:flex sm:items-center sm:gap-6">

                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                    >
                        {{ __('Dashboard') }}
                    </x-nav-link>

                </div>

            </div>

            {{-- DESKTOP USER MENU --}}
            <div class="hidden sm:ms-6 sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            type="button"
                            class="inline-flex items-center gap-2 rounded-xl border border-transparent px-3 py-2 text-sm font-medium text-gray-600 transition duration-200 hover:bg-brand-yellow/10 hover:text-brand-brown focus:outline-none focus:ring-2 focus:ring-brand-green/20"
                        >

                            <span>
                                {{ Auth::user()->name }}
                            </span>

                            <svg
                                class="h-4 w-4"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        {{-- PROFILE --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        {{-- LOGOUT --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- MOBILE HAMBURGER --}}
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl p-2 text-gray-500 transition duration-200 hover:bg-brand-yellow/10 hover:text-brand-brown focus:bg-brand-yellow/10 focus:outline-none"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            :class="{
                                'hidden': open,
                                'inline-flex': !open
                            }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{
                                'hidden': !open,
                                'inline-flex': open
                            }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12-12"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    {{-- RESPONSIVE NAVIGATION --}}
    <div
        :class="{
            'block': open,
            'hidden': !open
        }"
        class="hidden border-t border-gray-100 sm:hidden"
    >

        {{-- NAVIGATION LINKS --}}
        <div class="space-y-1 px-4 pb-3 pt-2">

            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
            >
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

        </div>

        {{-- USER INFORMATION --}}
        <div class="border-t border-gray-100 px-4 py-4">

            <div class="mb-3">

                <div class="text-base font-semibold text-brand-brown">
                    {{ Auth::user()->name }}
                </div>

                <div class="mt-0.5 text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>

            </div>

            {{-- MOBILE SETTINGS --}}
            <div class="space-y-1">

                <x-responsive-nav-link
                    :href="route('profile.edit')"
                >
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>

        </div>

    </div>

</nav>