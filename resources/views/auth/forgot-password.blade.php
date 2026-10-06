<x-guest-layout>

    {{-- HEADER --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-5 h-1 w-10 rounded-full bg-brand-yellow"></div>

        <h1 class="text-2xl font-semibold tracking-tight text-brand-brown">
            Forgot Password?
        </h1>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            {{ __('No problem. Enter your email address and we will send you a password reset link.') }}
        </p>

    </div>


    {{-- SESSION STATUS --}}
    <x-auth-session-status
        class="mb-5 rounded-xl bg-brand-green/5 px-4 py-3 text-sm text-brand-green"
        :status="session('status')"
    />


    {{-- FORM --}}
    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">

        @csrf


        {{-- EMAIL --}}
        <div>

            <x-input-label
                for="email"
                :value="__('Email')"
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
                autocomplete="email"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        {{-- BUTTON --}}
        <div>

            <x-primary-button
                class="w-full justify-center rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-brand-brown focus:bg-brand-brown active:bg-brand-brown"
            >
                {{ __('Email Password Reset Link') }}
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>