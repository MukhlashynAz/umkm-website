@php
    $company = \App\Models\CompanyProfile::first();
@endphp

<x-guest-layout>

    {{-- COMPANY LOGO --}}
    <div class="mb-8 flex justify-center">

        @if ($company?->logo)

            <img
                src="{{ asset('storage/' . $company->logo) }}"
                alt="{{ $company->company_name ?? 'Company Logo' }}"
                class="h-20 w-20 rounded-2xl object-contain"
            >

        @else

            <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-brand-yellow/30 px-2 text-center">
                <span class="text-xs font-bold leading-tight text-brand-brown">
                    {{ $company?->company_name ?? 'COMPANY' }}
                </span>
            </div>

        @endif

    </div>


    {{-- LOGIN HEADER --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-5 h-1 w-10 rounded-full bg-brand-yellow"></div>

        <h1 class="text-2xl font-semibold tracking-tight text-brand-brown">
            Admin Login
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Sign in to manage your website
        </p>

    </div>


    {{-- SESSION STATUS --}}
    <x-auth-session-status
        class="mb-5 rounded-xl bg-brand-green/5 px-4 py-3 text-sm text-brand-green"
        :status="session('status')"
    />


    {{-- LOGIN FORM --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-5">

        @csrf


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
                autofocus
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
                autocomplete="current-password"
                placeholder="Enter your password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- REMEMBER ME --}}
        <div>

            <label
                for="remember_me"
                class="inline-flex items-center"
            >

                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-brand-green shadow-sm focus:ring-brand-green"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Remember me
                </span>

            </label>

        </div>


        {{-- SIGN IN --}}
        <div>

            <x-primary-button
                class="w-full justify-center rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-brand-brown focus:bg-brand-brown active:bg-brand-brown"
            >
                {{ __('Sign In') }}
            </x-primary-button>

        </div>


        {{-- FORGOT PASSWORD --}}
        @if (Route::has('password.request'))

            <div class="text-center">

                <a
                    href="{{ route('password.request') }}"
                    class="text-sm font-medium text-gray-500 transition hover:text-brand-green"
                >
                    Forgot your password?
                </a>

            </div>

        @endif

    </form>


    {{-- BACK TO WEBSITE --}}
    <div class="mt-6 border-t border-gray-100 pt-5 text-center">

        <a
            href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-brand-green"
        >
            <span aria-hidden="true">←</span>
            Back to Website
        </a>

    </div>

</x-guest-layout>