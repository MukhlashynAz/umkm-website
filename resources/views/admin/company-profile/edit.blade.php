<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Company Profile</title>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">

    <div class="min-h-screen">

        {{-- HEADER --}}
        <div class="border-b border-brand-yellow/60 bg-white">
            <div class="mx-auto max-w-4xl px-6 py-8 lg:px-8">

                <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-brand-brown/60 transition hover:text-brand-green"
                        >
                            ← Back to Dashboard
                        </a>

                        <div class="mt-5">
                            <div class="mb-3 h-1 w-10 rounded-full bg-brand-yellow"></div>

                            <h1 class="text-3xl font-semibold tracking-tight text-brand-brown">
                                Company Profile
                            </h1>

                            <p class="mt-2 text-sm text-gray-500">
                                Manage your company information displayed on the website.
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>


        {{-- CONTENT --}}
        <main class="mx-auto max-w-4xl px-6 py-8 lg:px-8">


            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))

                <div class="mb-6 flex items-center gap-3 rounded-xl border border-brand-green/20 bg-brand-green/5 px-5 py-4 text-sm text-brand-green">

                    <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-brand-green text-white">
                        ✓
                    </div>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- VALIDATION ERROR --}}
            @if ($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                    <p class="font-semibold">
                        Please check the following:
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            {{-- FORM --}}
            <form
                action="{{ route('admin.company-profile.update') }}"
                method="POST"
                enctype="multipart/form-data"
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >

                @csrf
                @method('PUT')


                {{-- FORM HEADER --}}
                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <h2 class="font-semibold text-brand-brown">
                        Company Information
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Update the information that appears across your website.
                    </p>

                </div>


                <div class="space-y-7 px-6 py-7 sm:px-8">


                    {{-- COMPANY NAME --}}
                    <div>

                        <label
                            for="company_name"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Company Name
                        </label>

                        <input
                            type="text"
                            id="company_name"
                            name="company_name"
                            value="{{ old('company_name', $company?->company_name) }}"
                            required
                            class="mt-2 w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                            placeholder="Enter company name"
                        >

                    </div>


                    {{-- DESCRIPTION --}}
                    <div>

                        <label
                            for="description"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="mt-2 w-full resize-none rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                            placeholder="Describe your company"
                        >{{ old('description', $company?->description) }}</textarea>

                    </div>


                    {{-- ADDRESS --}}
                    <div>

                        <label
                            for="address"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            class="mt-2 w-full resize-none rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                            placeholder="Enter company address"
                        >{{ old('address', $company?->address) }}</textarea>

                    </div>


                    {{-- PHONE --}}
                    <div>

                        <label
                            for="phone"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Phone / WhatsApp
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone', $company?->phone) }}"
                            class="mt-2 w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                            placeholder="08xxxxxxxxxx"
                        >

                        <p class="mt-2 text-xs text-gray-400">
                            This number will also be used for WhatsApp contact.
                        </p>

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label
                            for="email"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $company?->email) }}"
                            class="mt-2 w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                            placeholder="company@email.com"
                        >

                    </div>


                    {{-- INSTAGRAM --}}
                    <div>

                        <label
                            for="instagram"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Instagram
                        </label>

                        <input
                            type="text"
                            id="instagram"
                            name="instagram"
                            value="{{ old('instagram', $company?->instagram) }}"
                            class="mt-2 w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                            placeholder="@yourinstagram"
                        >

                    </div>


                    {{-- LOGO --}}
                    <div>

                        <label
                            for="logo"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Company Logo
                        </label>


                        {{-- CURRENT LOGO --}}
                        @if ($company?->logo)

                            <div class="mt-3">

                                <div class="mb-2 flex items-center justify-between">

                                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                                        Current Logo
                                    </p>

                                    <span class="rounded-full bg-brand-yellow/30 px-3 py-1 text-[10px] font-semibold uppercase tracking-wider text-brand-brown">
                                        Existing
                                    </span>

                                </div>

                                <div class="flex h-32 w-32 items-center justify-center overflow-hidden rounded-2xl border border-gray-100 bg-brand-yellow/10">

                                    <img
                                        src="{{ asset('storage/' . $company->logo) }}"
                                        alt="{{ $company->company_name }}"
                                        class="h-full w-full object-contain"
                                    >

                                </div>

                            </div>

                        @else

                            <div class="mt-3 flex h-32 w-32 items-center justify-center rounded-2xl border border-dashed border-gray-200 bg-brand-yellow/10">

                                <div class="text-center">

                                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-brand-yellow/40 text-lg text-brand-brown">
                                        +
                                    </div>

                                    <span class="mt-2 block text-[10px] font-medium uppercase tracking-wider text-gray-400">
                                        No Logo
                                    </span>

                                </div>

                            </div>

                        @endif


                        {{-- NEW LOGO --}}
                        <input
                            type="file"
                            id="logo"
                            name="logo"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="mt-4 block w-full cursor-pointer rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-600 transition file:mr-4 file:rounded-lg file:border-0 file:bg-brand-green file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-brand-brown focus:border-brand-green focus:outline-none"
                        >

                        <p class="mt-2 text-xs text-gray-400">
                            JPG, JPEG, PNG, or WEBP. Maximum 2MB.
                        </p>

                    </div>


                </div>


                {{-- ACTIONS --}}
                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/60 px-6 py-5 sm:flex-row sm:justify-end sm:px-8">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-600 transition duration-200 hover:border-brand-green hover:text-brand-green"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-brand-green px-6 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-brand-brown hover:shadow-md"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </main>

    </div>

</body>
</html>