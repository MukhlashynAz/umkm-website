<x-guest-layout>

    {{-- HEADER --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-5 h-1 w-10 rounded-full bg-brand-yellow"></div>

        <h1 class="text-2xl font-semibold tracking-tight text-brand-brown">
            Reset Password
        </h1>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            Enter your new password below to regain access to your account.
        </p>

    </div>


    {{-- RESET FORM --}}
    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">

        @csrf


        {{-- PASSWORD RESET TOKEN --}}
        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
        >


        {{-- EMAIL --}}
        <div>

            <x-input-label
                for="email"
                :value="__('Email Address')"
                class="text-sm font-medium text-gray-700"
            />

            <x-text-input
                id="email"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 shadow-sm focus:border-brand-green focus:ring-brand-green"
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
                autofocus
                autocomplete="username"
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
                placeholder="Enter your new password"
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
                placeholder="Confirm your new password"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>


        {{-- RESET BUTTON --}}
        <div class="pt-1">

            <x-primary-button
                class="w-full justify-center rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-brand-brown focus:bg-brand-brown active:bg-brand-brown"
            >
                {{ __('Reset Password') }}
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>