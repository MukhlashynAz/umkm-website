<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Edit Category</title>
    <x-favicon />
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <div class="min-h-screen">

        {{-- HEADER --}}
        <div class="border-b border-brand-yellow/60 bg-white">
            <div class="mx-auto max-w-3xl px-6 py-8 lg:px-8">

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center text-sm font-medium text-brand-brown/60 transition hover:text-brand-green"
                >
                    ← Back to Categories
                </a>

                <div class="mt-5">
                    <div class="mb-3 h-1 w-10 rounded-full bg-brand-yellow"></div>

                    <h1 class="text-3xl font-semibold tracking-tight text-brand-brown">
                        Edit Category
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Update the category information and image.
                    </p>
                </div>

            </div>
        </div>


        {{-- CONTENT --}}
        <main class="mx-auto max-w-3xl px-6 py-8 lg:px-8">

            <form
                action="{{ route('admin.categories.update', $category) }}"
                method="POST"
                enctype="multipart/form-data"
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >

                @csrf
                @method('PUT')


                {{-- FORM HEADER --}}
                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <h2 class="font-semibold text-brand-brown">
                        Category Information
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Update the details below and save your changes.
                    </p>

                </div>


                <div class="space-y-7 px-6 py-7 sm:px-8">


                    {{-- CATEGORY NAME --}}
                    <div>

                        <label
                            for="name"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Category Name
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            required
                            class="mt-2 w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-green focus:ring-2 focus:ring-brand-green/10"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

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
                        >{{ old('description', $category->description) }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- CATEGORY IMAGE --}}
                    <div>

                        <label
                            for="image"
                            class="text-sm font-semibold text-brand-brown"
                        >
                            Category Image
                        </label>


                        {{-- CURRENT IMAGE --}}
                        @if ($category->image)

                            <div class="mt-3">

                                <div class="mb-2 flex items-center justify-between">

                                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                                        Current Image
                                    </p>

                                    <span class="rounded-full bg-brand-yellow/30 px-3 py-1 text-[10px] font-semibold uppercase tracking-wider text-brand-brown">
                                        Existing
                                    </span>

                                </div>

                                <div class="overflow-hidden rounded-2xl border border-gray-100 bg-brand-yellow/10">
                                    <img
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="h-52 w-full object-cover"
                                    >
                                </div>

                            </div>

                        @else

                            <div class="mt-3 flex h-52 w-full items-center justify-center rounded-2xl border border-dashed border-gray-200 bg-brand-yellow/10">

                                <div class="text-center">

                                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-brand-yellow/40 text-lg text-brand-brown">
                                        +
                                    </div>

                                    <span class="mt-3 block text-xs font-medium uppercase tracking-wider text-gray-400">
                                        No Image
                                    </span>

                                </div>

                            </div>

                        @endif


                        {{-- NEW IMAGE --}}
                        <input
                            id="image"
                            type="file"
                            name="image"
                            accept="image/*"
                            class="mt-3 block w-full cursor-pointer rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-600 transition file:mr-4 file:rounded-lg file:border-0 file:bg-brand-green file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-brand-brown focus:border-brand-green focus:outline-none"
                        >

                        <p class="mt-2 text-xs leading-relaxed text-gray-500">
                            Upload gambar baru jika ingin mengganti gambar lama.
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2MB.
                        </p>

                        @error('image')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                </div>


                {{-- ACTIONS --}}
                <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50/60 px-6 py-5 sm:flex-row sm:justify-end sm:px-8">

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="rounded-xl border border-gray-300 bg-white px-5 py-3 text-center text-sm font-semibold text-gray-600 transition duration-200 hover:border-brand-green hover:text-brand-green"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-brand-green px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-brand-brown hover:shadow-md"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </main>

    </div>

</body>
</html>