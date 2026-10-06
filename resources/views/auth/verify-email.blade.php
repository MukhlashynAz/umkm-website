<x-guest-layout>

    {{-- HEADER --}}
    <div class="mb-8 text-center">

        <div class="mx-auto mb-5 h-1 w-10 rounded-full bg-brand-yellow"></div>

        <h1 class="text-2xl font-semibold tracking-tight text-brand-brown">
            Verify Your Email
        </h1>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            Please verify your email address before continuing.
        </p>

    </div>


    {{-- MESSAGE --}}
    <div class="rounded-xl border border-gray-100 bg-gray-50 px-5 py-4 text-sm leading-6 text-gray-600">

        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}

    </div>


    {{-- SUCCESS STATUS --}}
    @if (session('status') == 'verification-link-sent')

        <div class="mt-4 rounded-xl border border-brand-green/20 bg-brand-green/5 px-5 py-4 text-sm font-medium leading-6 text-brand-green">

            {{ __('A new verification link has been sent to the email address you provided during registration.') }}

        </div>

    @endif


    {{-- ACTIONS --}}
    <div class="mt-6 space-y-3">


        {{-- RESEND VERIFICATION --}}
        <form method="POST" action="{{ route('verification.send') }}">

            @csrf

            <x-primary-button
                class="w-full justify-center rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-brand-brown focus:bg-brand-brown active:bg-brand-brown"
            >
                {{ __('Resend Verification Email') }}
            </x-primary-button>

        </form>


        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="w-full rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-600 transition duration-200 hover:border-brand-green hover:text-brand-green"
            >
                {{ __('Log Out') }}
            </button>

        </form>

    </div>

</x-guest-layout>