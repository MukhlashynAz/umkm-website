<x-guest-layout>

    {{-- HEADER --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-5 h-1 w-10 rounded-full bg-brand-yellow"></div>

        <h1 class="text-2xl font-semibold tracking-tight text-brand-brown">
            Create Account
        </h1>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            Create an account to access the website.
        </p>

    </div>


    {{-- REGISTER FORM --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-5">

        @csrf


        {{-- NAME --}}
        <div>

            <x-input-label
                for="name"
                :value="__('Name')"
                class="text-sm font-medium text-gray-700"
            />

            <x-text-input
                id="name"
                class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 shadow-sm focus:border-brand-green focus:ring-brand-green"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                placeholder="Enter your name"
            />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />

        </div>


        {{-- EMAIL --}}
        <div>

            <x-input-label
                for="email"
                :value="__('Email Address')"
                class="text-sm font-medium text-gray-700"
            />

            <x-text-input
                id="email"
                class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 shadow-sm focus:border-brand-green focus:ring-brand-green"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="admin@example.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        {{-- PASSWORD --}}
        <div>

            <x-input-label
                for="password"
                :value="__('Password')"
                class="text-sm font-medium text-gray-700"
            />

            <x-text-input
                id="password"
                class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 shadow-sm focus:border-brand-green focus:ring-brand-green"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Create a password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- CONFIRM PASSWORD --}}
        <div>

            <x-input-label
                for="password_confirmation"
                :value="__('Confirm Password')"
                class="text-sm font-medium text-gray-700"
            />

            <x-text-input
                id="password_confirmation"
                class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 shadow-sm focus:border-brand-green focus:ring-brand-green"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirm your password"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>


        {{-- ACTIONS --}}
        <div class="pt-1">

            <x-primary-button
                class="w-full justify-center rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-brand-brown focus:bg-brand-brown active:bg-brand-brown"
            >
                {{ __('Register') }}
            </x-primary-button>

        </div>


        {{-- LOGIN --}}
        <div class="text-center">

            <a
                href="{{ route('login') }}"
                class="text-sm font-medium text-gray-500 transition hover:text-brand-green"
            >
                {{ __('Already registered?') }}
            </a>

        </div>

    </form>

</x-guest-layout>