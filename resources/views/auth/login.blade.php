<x-guest-layout>

<div class="mb-8 text-center">
    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">
        Admin Login
    </h1>

    <p class="mt-2 text-sm text-gray-500">
        Sign in to manage your website
    </p>
</div>

<!-- Session Status -->
<x-auth-session-status
    class="mb-4"
    :status="session('status')"
/>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email -->
    <div>
        <x-input-label
            for="email"
            :value="__('Email Address')"
        />

        <x-text-input
            id="email"
            class="block mt-1 w-full"
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

    <!-- Password -->
    <div class="mt-5">
        <x-input-label
            for="password"
            :value="__('Password')"
        />

        <x-text-input
            id="password"
            class="block mt-1 w-full"
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

    <!-- Remember Me -->
    <div class="mt-5">
        <label
            for="remember_me"
            class="inline-flex items-center"
        >
            <input
                id="remember_me"
                type="checkbox"
                class="rounded border-gray-300 text-gray-900 shadow-sm focus:ring-gray-400"
                name="remember"
            >

            <span class="ms-2 text-sm text-gray-600">
                Remember me
            </span>
        </label>
    </div>

    <!-- Actions -->
    <div class="mt-6">
        <x-primary-button class="w-full justify-center py-3">
            {{ __('Sign In') }}
        </x-primary-button>
    </div>

    @if (Route::has('password.request'))
        <div class="mt-5 text-center">
            <a
                href="{{ route('password.request') }}"
                class="text-sm text-gray-500 transition hover:text-gray-900"
            >
                Forgot your password?
            </a>
        </div>
    @endif
</form>

<!-- Back to Website -->
<div class="mt-6 border-t border-gray-100 pt-5 text-center">
    <a
        href="{{ route('home') }}"
        class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-gray-900"
    >
        <span aria-hidden="true">←</span>
        Back to Website
    </a>
</div>

</x-guest-layout>