<x-guest-layout>

    {{-- HEADER --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-5 h-1 w-10 rounded-full bg-brand-yellow"></div>

        <h1 class="text-2xl font-semibold tracking-tight text-brand-brown">
            Confirm Password
        </h1>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>

    </div>


    {{-- FORM --}}
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">

        @csrf


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
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- BUTTON --}}
        <div>

            <x-primary-button
                class="w-full justify-center rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-brand-brown focus:bg-brand-brown active:bg-brand-brown"
            >
                {{ __('Confirm') }}
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>