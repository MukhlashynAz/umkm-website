<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Company Profile</title>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900">

    <div class="mx-auto max-w-4xl px-6 py-10 lg:px-8">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-3xl font-bold tracking-tight">
                    Company Profile
                </h1>

                <p class="mt-2 text-gray-500">
                    Manage your company information displayed on the website.
                </p>
            </div>

            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:border-gray-900 hover:text-gray-900"
            >
                ← Back to Dashboard
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="mt-8 rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- VALIDATION ERROR --}}
        @if ($errors->any())
            <div class="mt-8 rounded-lg border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

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
        <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

            <form
                action="{{ route('admin.company-profile.update') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >

                @csrf
                @method('PUT')


                {{-- COMPANY NAME --}}
                <div>
                    <label
                        for="company_name"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Company Name
                    </label>

                    <input
                        type="text"
                        id="company_name"
                        name="company_name"
                        value="{{ old('company_name', $company?->company_name) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
                        placeholder="Enter company name"
                    >
                </div>


                {{-- DESCRIPTION --}}
                <div>
                    <label
                        for="description"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
                        placeholder="Describe your company"
                    >{{ old('description', $company?->description) }}</textarea>
                </div>


                {{-- ADDRESS --}}
                <div>
                    <label
                        for="address"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
                        placeholder="Enter company address"
                    >{{ old('address', $company?->address) }}</textarea>
                </div>


                {{-- PHONE --}}
                <div>
                    <label
                        for="phone"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Phone / WhatsApp
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $company?->phone) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
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
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $company?->email) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
                        placeholder="company@email.com"
                    >
                </div>


                {{-- INSTAGRAM --}}
                <div>
                    <label
                        for="instagram"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Instagram
                    </label>

                    <input
                        type="text"
                        id="instagram"
                        name="instagram"
                        value="{{ old('instagram', $company?->instagram) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-black"
                        placeholder="@yourinstagram"
                    >
                </div>


                {{-- LOGO --}}
                <div>
                    <label
                        for="logo"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Company Logo
                    </label>

                    @if ($company?->logo)
                        <div class="mb-4">
                            <p class="mb-2 text-xs font-medium uppercase tracking-wider text-gray-400">
                                Current Logo
                            </p>

                            <div class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                                <img
                                    src="{{ asset('storage/' . $company->logo) }}"
                                    alt="{{ $company->company_name }}"
                                    class="h-full w-full object-contain"
                                >
                            </div>
                        </div>
                    @endif

                    <input
                        type="file"
                        id="logo"
                        name="logo"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition file:mr-4 file:rounded-md file:border-0 file:bg-gray-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-700"
                    >

                    <p class="mt-2 text-xs text-gray-400">
                        JPG, JPEG, PNG, or WEBP. Maximum 2MB.
                    </p>
                </div>


                {{-- ACTION --}}
                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 transition hover:border-gray-900 hover:text-gray-900"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-lg bg-gray-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-gray-700"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>